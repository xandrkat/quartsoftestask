<?php

namespace app\models;

class Cadastr extends \yii\db\ActiveRecord
{
    public $file;
    const SAVE_PATH = '/inc/files';
    public static function tableName()
    {
        return 'сadastr';
    }
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['cn'], 'required'],
            [['lat', 'lng', 'cn',], 'string'],
            [['cn',], 'unique'],
            [['file',], 'file', 'skipOnEmpty' => false, 'extensions' => 'ods, xls'],
        ];
    }
}