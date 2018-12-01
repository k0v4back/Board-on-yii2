<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dialog`.
 */
class m181201_123232_create_dialog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dialog', [
            'id' => $this->primaryKey(),
            'advert_id' => $this->integer(),
            'owner_id' => $this->integer(),
            'client_id' => $this->integer(),
            'created_at' => $this->string()->notNull(),
            'updated_at' => $this->string(),
            'user_new_messages' => $this->integer(),
            'client_new_messages' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('dialog');
    }
}
