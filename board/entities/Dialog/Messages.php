<?php

namespace board\entities\dialog;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $dialog_id
 * @property string $user_id
 * @property string $message
 * @property string $owner_id
 */
class Messages extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%messages}}';
    }
}
