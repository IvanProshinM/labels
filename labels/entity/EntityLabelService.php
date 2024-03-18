<?php

namespace app\services\entity;


use app\services\entity\exception\EntityLabelNotFoundException;
use app\services\entity\exception\EntityLabelParamException;
use app\services\entity\exception\EntityLabelValidationException;
use app\services\entity\exception\EntityNotFoundException;
use app\services\entity\exception\LabelNotFoundException;
use app\services\entity\repositories\EntityLabelRepository;
use app\services\entity\repositories\EntityRepository;
use app\services\entity\repositories\LabelRepository;

class EntityLabelService
{

    private EntityRepository $entityRepository;
    private EntityLabelRepository $entityLabelRepository;
    private LabelRepository $labelRepository;

    public function __construct(
        EntityRepository      $entityRepository,
        EntityLabelRepository $entityLabelRepository,
        LabelRepository       $labelRepository
    )
    {
        $this->entityRepository = $entityRepository;
        $this->entityLabelRepository = $entityLabelRepository;
        $this->labelRepository = $labelRepository;
    }

    /**
     * @param int $entityId
     * @param int $entityType
     * @param array $labelList
     * @throws EntityLabelNotFoundException
     * @throws EntityLabelValidationException
     * @throws EntityNotFoundException
     */
    public function rewriteEntityLabel(int $entityId, int $entityType, array $labelList): void
    {
        $entity = $this->entityRepository->getEntityByIdByType($entityId, $entityType);
        if ($entity === null) {
            throw new EntityNotFoundException($entityId);
        }
        $newEntityLabelsList = [];
        foreach ($labelList as $newLabel) {
            $label = $this->labelRepository->getLabelByLabelName($newLabel);
            if ($label === null) {
                throw new LabelNotFoundException($newLabel);
            }
            $entityLabel = new EntityLabel();
            $entityLabel->entity_id = $entityId;
            $entityLabel->entity_type = $entityType;
            $entityLabel->label_id = $label->id;
            if (!$entityLabel->validate()) {
                throw new EntityLabelValidationException($entityId, $newLabel, $entityLabel->firstErrors);
            }
            $newEntityLabelsList[] = $entityLabel;
        }
        $this->deleteOldLabel($entityId);
        $this->saveNewLabels($newEntityLabelsList);

    }

    /**
     * @param int $entityId
     * @param int $entityType
     * @param array $labelList
     * @throws EntityLabelParamException
     * @throws EntityLabelValidationException
     * @throws EntityNotFoundException
     */
    public function createEntityLabel(int $entityId, int $entityType, array $labelList): void
    {
        if (empty($labelList) === true) {
            throw new EntityLabelParamException();
        }
        $entity = $this->entityRepository->getEntityByIdByType($entityId, $entityType);
        if ($entity === null) {
            throw new EntityNotFoundException($entityId);
        }
        foreach ($labelList as $newLabel) {
            $label = $this->labelRepository->getLabelByLabelName($newLabel);
            if ($label === null) {
                throw new LabelNotFoundException($newLabel);
            }
            $entityLabel = new EntityLabel();
            $entityLabel->label_id = $label->id;
            $entityLabel->entity_id = $entityId;
            $entityLabel->entity_type = $entityType;
            if (!$entityLabel->validate()) {
                throw new EntityLabelValidationException($entityId, $label->id, $entityLabel->firstErrors);
            }
            $entityLabel->save();
        }
    }

    /**
     * @param int $entityId
     * @param int $entityType
     * @param array $labelList
     * @throws EntityLabelNotFoundException
     * @throws EntityLabelParamException
     * @throws EntityNotFoundException
     * @throws LabelNotFoundException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteLabel(int $entityId, int $entityType, array $labelList)
    {
        if (empty($labelList) === true) {
            throw new EntityLabelParamException();
        }
        $entity = $this->entityRepository->getEntityByIdByType($entityId, $entityType);
        if ($entity === null) {
            throw new EntityNotFoundException($entityId);
        }
        foreach ($labelList as $label) {
            $label = $this->labelRepository->getLabelByLabelName($label);
            if ($label === null) {
                throw new LabelNotFoundException($label);
            }
            $entityLabel = $this->entityLabelRepository->getLabelByEntityIdByLabelId($entityId, $label->id);
            if ($entityLabel === null) {
                throw new EntityLabelNotFoundException($entityId, $label->id);
            }
            $entityLabel->delete();
        }
    }

    /**
     * @param int $entityId
     * @param int $entityType
     * @return array
     * @throws EntityNotFoundException
     */
    public function getLabelList(int $entityId, int $entityType): array
    {
        $result = [];
        $entity = $this->entityRepository->getEntityByIdByType($entityId, $entityType);
        if ($entity === null) {
            throw new EntityNotFoundException($entityId);
        }
        $labelList = $this->labelRepository->getLabelListByEntityId($entityId);
        foreach ($labelList as $label) {
            $result[] = $label->label;
        }
        return $result;
    }

    /**
     * @param int $entityId
     */
    private function deleteOldLabel(int $entityId): void
    {
        $labelList = $this->entityLabelRepository->getLabelListByEntityId($entityId);
        foreach ($labelList as $label) {
            $label->delete();
        }
    }

    /**
     * @param array $entityLabelList
     */
    private function saveNewLabels(array $entityLabelList): void
    {
        foreach ($entityLabelList as $entityLabel) {
            $entityLabel->save();
        }
    }


}