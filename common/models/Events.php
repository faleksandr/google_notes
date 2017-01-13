<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.01.2017
 * Time: 16:54
 */

namespace common\models;


use yii\db\ActiveRecord;

class Events extends ActiveRecord
{

    public static function tableName()
    {
        return 'events';
    }
}