<?php

namespace app\services\entity;


use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $label
 */
class Label extends ActiveRecord
{

    public static function tableName()
    {
        return 'label';
    }

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['label'], 'required'],
            [['label'], 'string']
        ];
    }

    public static function find()
    {
        return new LabelQuery(static::class);
    }

}