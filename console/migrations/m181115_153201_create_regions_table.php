<?php

use yii\db\Migration;

/**
 * Handles the creation of table `regions`.
 */
class m181115_153201_create_regions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('regions', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'slug' => $this->string()->unique()->notNull(),
            'parent_id' => $this->integer()->defaultValue(NULL),
        ]);

        $this->createIndex(
            'idx-regions-name',
            'regions',
            'name'
        );

        $this->addForeignKey(
            'fk-regions-name',
            'regions',
            'parent_id',
            'regions',
            'id',
            'CASCADE'
        );

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('regions');
    }
}
