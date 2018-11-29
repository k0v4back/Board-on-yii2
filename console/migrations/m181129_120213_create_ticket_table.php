<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket`.
 */
class m181129_120213_create_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ticket', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'created_at' => $this->string()->notNull(),
            'updated_at' => $this->string(),
            'subject' => $this->string()->notNull(),
            'content' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ticket');
    }
}
