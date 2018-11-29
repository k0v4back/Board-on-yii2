<?php

namespace board\entities\ticket;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $subject
 * @property string $content
 * @property int $status
 */
class Ticket extends \yii\db\ActiveRecord
{

}
