<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%entity_label}}`.
 */
class m240317_092006_create_entity_label_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('entity', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull(),
        ]);

        $this->createTable('entity_label', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'entity_type' => $this->integer()->notNull(),
            'label_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('label', [
            'id' => $this->primaryKey(),
            'label' => $this->string()->notNull()
        ]);

        $this->addForeignKey('entityId', 'entity_label', 'entity_id', 'entity', 'id');
        $this->addForeignKey('labelId', 'entity_label', 'label_id', 'label', 'id');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('entityId','entity_label');
        $this->dropForeignKey('labelId','entity_label');
        $this->dropTable('entity_label');
        $this->dropTable('entity');
        $this->dropTable('label');
    }
}
