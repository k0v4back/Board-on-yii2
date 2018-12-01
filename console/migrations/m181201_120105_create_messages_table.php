<?php

use yii\db\Migration;

/**
 * Handles the creation of table `messages`.
 */
class m181201_120105_create_messages_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('messages', [
            'id' => $this->primaryKey(),
            'dialog_id' => $this->integer(),
            'user_id' => $this->string(),
            'message' => $this->text(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('messages');
    }
}
