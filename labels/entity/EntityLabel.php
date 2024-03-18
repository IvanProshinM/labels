<?php

namespace app\services\entity;


use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $entity_id
 * @property int $entity_type
 * @property int $label_id
 */
class EntityLabel extends ActiveRecord
{
    public static function tableName()
    {
        return 'entity_label';
    }

    public function rules()
    {
        return [
            [['id', 'entity_id', 'entity_type', 'label_id'], 'integer'],
            [['entity_id', 'entity_type', 'label_id'], 'required']
        ];
    }


    public static function find()
    {
        return new EntityLabelQuery(static::class);
    }
}