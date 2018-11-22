<?php

use yii\db\Migration;

/**
 * Handles the creation of table `avatart`.
 */
class m181122_063733_create_avatart_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('avatar', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'user_id' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('avatart');
    }
}
