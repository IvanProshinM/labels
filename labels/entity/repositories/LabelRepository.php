<?php

namespace app\services\entity\repositories;

use app\services\entity\Label;

class LabelRepository
{

    /**
     * @param string $labelName
     * @return Label|array|null
     */
    public function getLabelByLabelName(string $labelName): ?Label
    {
        return Label::find()
            ->byLabel($labelName)
            ->one();
    }

    /**
     * @param int $entityId
     * @return Label[]|array
     */
    public function getLabelListByEntityId(int $entityId): array
    {
        return Label::find()
            ->select('label.*')
            ->innerJoin('entity_label as el','el.label_id=label.id')
            ->innerJoin('entity as e', 'e.id=el.entity_id')
            ->andWhere(['e.id' => $entityId])
            ->all();
    }
}