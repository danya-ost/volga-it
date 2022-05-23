<?php


namespace frontend\models;


use yii\db\ActiveRecord;

class Dictionaries extends ActiveRecord
{

    public static function tableName()
    {
        return 'dictionaries';
    }

    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required', 'message' => 'Это поле обязательно для заполнения!']
        ];
    }
}