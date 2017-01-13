<?php

namespace common\models;

use Yii;

class EditForm extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'tags', 'img'], 'string'],
            [['name', 'img'], 'string', 'max' => 255],
            ['text', 'trim'],
            ['tags', 'trim'],
        ];
    }
}
