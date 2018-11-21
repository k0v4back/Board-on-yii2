<?php

use yii\db\Migration;

/**
 * Class m181121_081252_down_type_column
 */
class m181121_081252_down_type_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'phone_verified_token_expire');
        $this->addColumn('user', 'phone_verified_token_expire', $this->integer(255)->defaultValue(null)->after('phone_verified_token'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'phone_verified_token_expire');
    }

}
