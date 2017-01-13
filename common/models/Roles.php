<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.01.2017
 * Time: 16:36
 */

namespace common\models;


use yii\db\ActiveRecord;

class Roles extends ActiveRecord
{
    public static function tableName()
    {
        return 'roles';
    }
}