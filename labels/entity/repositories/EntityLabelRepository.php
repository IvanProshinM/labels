<?php

namespace app\services\entity\repositories;

use app\services\entity\EntityLabel;

class EntityLabelRepository
{
    public function getLabelByEntityIdByLabelId(int $entityId, string $label): ?EntityLabel
    {
        return EntityLabel::find()
            ->byEntityId($entityId)
            ->byLabelId($label)
            ->one();
    }

    /**
     * @param int $entityId
     * @return array
     */
    public function getLabelListByEntityId(int $entityId): array
    {
        return EntityLabel::find()
            ->byEntityId($entityId)
            ->all();
    }
}