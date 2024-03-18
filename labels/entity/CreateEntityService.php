<?php

namespace app\services\entity;

class CreateEntityService
{

    /**
     * @throws \Exception
     */
    public function create()
    {
        $entityTypeList = [
            Entity::ENTITY_USER,
            Entity::ENTITY_COMPANY,
            Entity::ENTITY_WEBSITE,
        ];

        foreach ($entityTypeList as $entityType) {
            $entity = new Entity();
            $entity->type = $entityType;
            if (!$entity->validate()) {
                throw new \Exception('Ошибка создания сущности');
            }
            $entity->save();
        }
    }


}