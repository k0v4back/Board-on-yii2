<?php

namespace board\entities\dialog;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "dialog".
 *
 * @property int $id
 * @property int $owner
 * @property int $user
 */
class Dialog extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%dialog}}';
    }
}
