<?php

namespace app\services\entity\repositories;

use app\services\entity\Entity;

class EntityRepository
{
    public function getEntityByIdByType(int $id, int $type)
    {
       return Entity::find()
           ->byId($id)
           ->byType($type)
           ->one();
    }
}