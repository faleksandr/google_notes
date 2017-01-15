<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "notes".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $img
 * @property string $tags
 */
class Notes extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $cat;
    public $image;

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
            [['name'], 'string', 'max' => 255],
            ['cat', 'trim'],
            ['visibility', 'trim'],
            ['author', 'trim'],
            ['author_id', 'integer'],
            [['image'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            return true;
        } else {
            return false;
        }
    }

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
