<?php

use yii\db\Migration;

/**
 * Handles the creation of table `advert`.
 */
class m181122_152711_create_advert_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('advert', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'region_id' => $this->integer(),

            'title' => $this->string(150)->notNull(),
            'price' => $this->integer()->notNull(),
            'address' => $this->string(),
            'content' => $this->text()->notNull(),

            'status' => $this->integer()->notNull(),
            'reject_reason' => $this->text(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'published_at' => $this->integer(),
            'expired_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('advert_foreign_user', 'advert', 'user_id', 'user', 'id', 'CASCADE');

        $this->addForeignKey('advert_foreign_category', 'advert', 'category_id', 'borad_categories', 'id', 'CASCADE');

        $this->addForeignKey('advert_foreign_regions', 'advert', 'region_id', 'regions', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('advert');
    }
}
