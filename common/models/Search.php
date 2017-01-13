<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.01.2017
 * Time: 14:08
 */

namespace common\models;

use yii\db\ActiveRecord;

class Search extends ActiveRecord
{
    public $search;

    public function rules()
    {
        return [
            ['tags', 'trim'],
        ];
    }

}