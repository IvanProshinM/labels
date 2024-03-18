<?php

namespace app\services\entity;

use yii\db\ActiveQuery;

class LabelQuery extends ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \app\services\entity\Label[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\services\entity\Label|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param string $label
     * @return $this
     */
    public function byLabel(string $label): self
    {
        $this->andWhere(['label' => $label]);
        return $this;
    }

}