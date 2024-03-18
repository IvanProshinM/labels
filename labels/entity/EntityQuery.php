<?php

namespace app\services\entity;

use yii\db\ActiveQuery;

class EntityQuery extends ActiveQuery
{
    /**
     * @param null $db
     * @return array|\yii\db\ActiveRecord[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @param null $db
     * @return array|\yii\db\ActiveRecord|null
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
     * @param int $type
     * @return $this
     */
    public function byType(int $type): self
    {
        $this->andWhere(['type' => $type]);
        return $this;
    }

}