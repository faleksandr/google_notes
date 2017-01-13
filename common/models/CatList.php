<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.01.2017
 * Time: 12:03
 */

namespace common\models;


use yii\db\ActiveRecord;

class CatList extends ActiveRecord
{

    public static function tableName()
    {
        return 'categories_notes';
    }

    public function rules()
    {
        return [
            [['notes_id', 'category_id'], 'integer'],
        ];
    }
}