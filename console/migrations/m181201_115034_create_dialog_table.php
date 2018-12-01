<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dialog`.
 */
class m181201_115034_create_dialog_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('dialog', [
            'id' => $this->primaryKey(),
            'owner' => $this->integer(),
            'user' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('dialog');
    }
}
