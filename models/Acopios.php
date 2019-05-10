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
            [['nom_aco', 'ubi_aco'], 'required'],
            [['ubi_aco', 'stock'], 'integer'],
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

}
