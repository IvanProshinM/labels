<?php

namespace app\services\entity;


use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $type
 */
class Entity extends ActiveRecord
{

    public const ENTITY_USER = 1;
    public const ENTITY_COMPANY = 2;
    public const ENTITY_WEBSITE = 3;


    public static function tableName()
    {
        return 'entity';
    }

    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['type'], 'required']
        ];
    }

    public static function find()
    {
        return new EntityQuery(static::class);
    }

}