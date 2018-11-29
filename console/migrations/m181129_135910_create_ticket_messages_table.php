<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket_messages`.
 */
class m181129_135910_create_ticket_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ticket_messages', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'ticket_id' => $this->integer(),
            'content' => $this->integer(),
            'created_at' => $this->string(),
            'updated_at' => $this->string(),
        ]);

        $this->addForeignKey('fk-ticker_message-key', 'ticket_messages', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk-ticker_message_ticket-key', 'ticket_messages', 'ticket_id', 'ticket', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ticket_messages');
    }
}
