<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.01.2017
 * Time: 2:24
 */

namespace common\models;


use yii\db\ActiveRecord;

class Mailer extends ActiveRecord
{
    public static function tableName
    {
        return 'mail';
    }

    public function attributeLabels()
    {
        return [
            'theme' => 'Тема рассылки',
            'text' => 'Текст',
        ];
    }

    public function rules()
    {
        return [
            [['theme','text','html'], 'required'],
        ];
    }

}