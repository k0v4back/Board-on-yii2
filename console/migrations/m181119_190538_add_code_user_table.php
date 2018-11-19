<?php

use yii\db\Migration;

/**
 * Class m181119_190538_add_code_user_table
 */
class m181119_190538_add_code_user_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'code', $this->string(100)->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'code');

    }
}
