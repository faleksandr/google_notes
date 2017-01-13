<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.01.2017
 * Time: 22:23
 */

namespace common\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'categories';
    }

}