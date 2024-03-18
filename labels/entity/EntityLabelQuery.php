<?php

namespace app\services\entity;

use yii\db\ActiveQuery;

class EntityLabelQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \app\services\entity\EntityLabel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\services\entity\EntityLabel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function byId(int $id): self
    {
        $this->andWhere(['id' => $id]);
        return $this;
    }

    /**
     * @param int $entityId
     * @return $this
     */
    public function byEntityId(int $entityId): self
    {
        $this->andWhere(['entity_id' => $entityId]);
        return $this;
    }

    /**
     * @param int $labelId
     * @return $this
     */
    public function byLabelId(int $labelId): self
    {
        $this->andWhere(['label_id' => $labelId]);
        return $this;
    }

}