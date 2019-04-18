<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cereales".
 *
 * @property int $id_cer
 * @property string $nom_cer
 * @property string $var_cer
 */
class Cereales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cereales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom_cer', 'var_cer'], 'required'],
            [['nom_cer'], 'string', 'max' => 50],
            [['var_cer'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cer' => 'Id Cer',
            'nom_cer' => 'Nombre',
            'var_cer' => 'Variedad',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CerealesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CerealesQuery(get_called_class());
    }
}
