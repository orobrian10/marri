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
            [['ubi_aco', 'cer_aco', 'lot_aco', 'sil_aco', 'stock'], 'integer'],
            [['nom_aco'], 'string', 'max' => 50],
            [['cer_aco'], 'exist', 'skipOnError' => true, 'targetClass' => Cereales::className(), 'targetAttribute' => ['cer_aco' => 'id_cer']],
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
            'stock' => 'Stock (qq)'
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

    public function getlocalidades()
    {
        return $this->hasOne(Localidades::className(), ['id_loc' => 'ubi_aco']);
    }

    public function getcereales()
    {
        return $this->hasOne(Cereales::className(), ['id_cer' => 'cer_aco']);
    }
}
