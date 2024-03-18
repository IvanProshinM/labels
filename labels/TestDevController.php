<?php

namespace app\controllers;

use app\services\entity\Entity;
use app\services\entity\EntityLabelService;

use yii\web\Controller;

class TestDevController extends Controller
{

    private EntityLabelService $entityLabelService;

    public function __construct(
        $id,
        $module,
        EntityLabelService $entityLabelService,
        $config = []
    )
    {
        $this->entityLabelService = $entityLabelService;
        parent::__construct($id, $module, $config);
    }


    // P.S. Не учел создание дублей при создании связи сущностей и лейблов
    // Сделано на Yii2, с исп. PostgreSQL
    // Класс для работы с лейблами - EntityLabelService



    // Переписываем лейблы сущности
    public function actionRewrite()
    {
        $entityId = 1;
        $labelList = [
            'Ехал',
            'Рак',
            'В реке'
        ];
        $entityType = Entity::ENTITY_USER;
        try {
            $this->entityLabelService->rewriteEntityLabel($entityId, Entity::ENTITY_USER, $labelList);
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }

    // Создаем связь лейблов и сущности
    public function actionCreate()
    {
        $entityId = 1;
        $labelList = [
            'Грека',
            'Через',
            'Реку'
        ];
        $entityType = Entity::ENTITY_USER;
        try {
            $this->entityLabelService->createEntityLabel($entityId, $entityType, $labelList);
        } catch (\Throwable $e) {

        }
    }

    // Удаляем лейблы из сущности
    public function actionDelete()
    {
        $entityId = 1;
        $entityType = Entity::ENTITY_USER;
        $labelList = [
            'Ехал',
            'В реке'
        ];
        try {
            $this->entityLabelService->deleteLabel($entityId, $entityType, $labelList);
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }

    }

    // Получаем лейблы для сущности
    public function actionGetLabels()
    {
        $entityId = 1;
        $entityType = Entity::ENTITY_USER;
        try {
            $labelList = $this->entityLabelService->getLabelList($entityId, $entityType);
        } catch (\Throwable $e) {
            $e->getMessage();
        }
        foreach ($labelList as $label) {
            echo $label . "<br>";
        }
    }
}