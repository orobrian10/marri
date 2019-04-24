<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "variedades".
 *
 * @property int $id_var
 * @property string $des_var
 */
class Variedades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variedades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_var','cer_var'], 'required'],
            ['cer_var', 'integer'],
            [['des_var'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_var' => 'Id Var',
            'cer_var' => 'Cereal',
            'des_var' => 'Variedad',
        ];
    }

    /**
     * {@inheritdoc}
     * @return VariedadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VariedadesQuery(get_called_class());
    }
}
