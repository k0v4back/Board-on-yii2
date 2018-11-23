<?php

use yii\db\Migration;

/**
 * Class m181123_131026_add_city_in_advert_table
 */
class m181123_131026_add_city_in_advert_table extends Migration
{
    public function up()
    {
        $this->addColumn('advert', 'city', $this->string());
    }

    public function down()
    {
        $this->dropColumn('advert', 'city');
    }
}
