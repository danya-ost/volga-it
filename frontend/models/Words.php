<?php


namespace frontend\models;


use yii\db\ActiveRecord;

class Words extends ActiveRecord
{
    public static function tableName()
    {
        return 'words';
    }

    public function rules()
    {
        return [
            [['dictionaries_id', 'word_en', 'word_ru', 'image_name'], 'trim']
        ];
    }
}