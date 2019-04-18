<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acopios".
 *
 * @property int $id_aco
 * @property string $nom_aco
 * @property int $ubi_aco
 * @property int $cer_aco
 * @property int $lot_aco
 * @property int $sil_aco
 */
class Acopios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'acopios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom_aco', 'ubi_aco', 'cer_aco', 'lot_aco'], 'required'],
            [['ubi_aco', 'cer_aco', 'lot_aco', 'sil_aco'], 'integer'],
            [['nom_aco'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_aco' => 'Id Aco',
            'nom_aco' => 'Nombre',
            'ubi_aco' => 'Ubicación',
            'cer_aco' => 'Tipo de Cereal',
            'lot_aco' => 'Lote',
            'sil_aco' => 'Tipo de Silo',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AcopiosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcopiosQuery(get_called_class());
    }

    public function getlugares()
    {
        return $this->hasOne(AcopiosLugares::className(), ['id_lug' => 'ubi_aco']);
    }
}