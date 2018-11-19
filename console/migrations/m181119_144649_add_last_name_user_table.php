<?php

use yii\db\Migration;

/**
 * Class m181119_144649_add_last_name_user_table
 */
class m181119_144649_add_last_name_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'last_name', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'last_name');
    }

}
