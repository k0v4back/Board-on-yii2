<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photo`.
 */
class m181123_073000_create_photo_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('photo', [
            'id' => $this->primaryKey(),
            'advert_id' => $this->integer(),
            'name' => $this->string(),
            'created_at' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk-photo-advert', 'photo', 'advert_id', 'advert', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('photo');
    }
}
