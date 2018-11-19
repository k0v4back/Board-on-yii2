<?php

use yii\db\Migration;

/**
 * Class m181119_172919_add_phone_user_table
 */
class m181119_172919_add_phone_user_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'phone', $this->string(100)->defaultValue(null)->after('email'));
        $this->addColumn('user', 'phone_verified', $this->boolean()->defaultValue(false)->after('phone'));
        $this->addColumn('user', 'phone_verified_token', $this->string()->defaultValue(null)->after('phone_verified'));
        $this->addColumn('user', 'phone_verified_token_expire', $this->timestamp()->defaultValue(null)->after('phone_verified_token'));
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'phone_verified_token_expire');
        $this->dropColumn('user', 'phone_verified_token');
        $this->dropColumn('user', 'phone_verified');
        $this->dropColumn('user', 'phone');
    }
}
