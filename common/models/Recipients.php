<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.01.2017
 * Time: 11:34
 */

namespace common\models;


use yii\db\ActiveRecord;

class Recipients extends ActiveRecord
{
    public static function tableName()
    {
        return 'recipients';
    }
}