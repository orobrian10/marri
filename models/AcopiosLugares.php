<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acopios_lugares".
 *
 * @property int $id_lug
 * @property string $nom_lug
 */
class AcopiosLugares extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acopios_lugares';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom_lug'], 'required'],
            [['nom_lug'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lug' => 'Id Lug',
            'nom_lug' => 'Lugares',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AcopiosLugaresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcopiosLugaresQuery(get_called_class());
    }
}
