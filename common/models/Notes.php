<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $img
 * @property string $tags
 */
class Notes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $cat;

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
            [['text', 'tags'], 'string'],
            [['name', 'img'], 'string', 'max' => 255],
            ['cat', 'trim'],
            ['visibility', 'trim'],
            ['author', 'trim'],
            ['author_id', 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'text' => 'Text',
            'img' => 'Img',
            'tags' => 'Tags',
        ];
    }
}
