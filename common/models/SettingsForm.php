<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.01.2017
 * Time: 18:50
 */

namespace common\models;

use yii\db\ActiveRecord;

class SettingsForm extends ActiveRecord
{
    //public $calendar_id;

    public static function tableName()
    {
        return 'user';
    }

    public function attributeLabels()
    {
        return [
            'calendar_id' => 'Ссылка на календарь',
        ];
    }

    public function rules()
    {
        return [
            ['calendar_id', 'required'],
            ['calendar_id', 'string', 'min' => 50, 'max' => 255],
        ];
    }

}