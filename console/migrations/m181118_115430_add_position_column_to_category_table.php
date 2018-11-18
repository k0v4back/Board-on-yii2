<?php

use yii\db\Migration;

/**
 * Handles adding position to table `category`.
 */
class m181118_115430_add_position_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('borad_categories', 'parentId', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('borad_categories', 'parentId');
    }
}
