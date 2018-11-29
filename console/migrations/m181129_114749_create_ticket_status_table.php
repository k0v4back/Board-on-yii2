<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket_status`.
 */
class m181129_114749_create_ticket_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ticket_status', [
            'id' => $this->primaryKey(),
            'ticket_id' => $this->integer(),
            'user_id' => $this->integer(),
            'created_at' => $this->string()->notNull(),
            'updated_at' => $this->string(),
            'status' => $this->integer(),
        ]);

        $this->addForeignKey('fk-ticket_status-advert', 'ticket_status', 'user_id', 'user', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ticket_status');
    }
}
