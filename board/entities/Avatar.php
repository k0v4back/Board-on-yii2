<?php

namespace board\entities;

use Yii;

/**
 * This is the model class for table "avatar".
 *
 * @property int $id
 * @property string $name
 * @property string $user_id
 */
class Avatar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%avatar}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'user_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
        ];
    }

    public function getAvatar()
    {
        return $this->hasOne(User::class, ['id', 'user_id']);
    }
}
