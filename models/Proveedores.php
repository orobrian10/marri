<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property int $id_pro
 * @property string $nom_pro
 * @property int $tel_pro
 * @property int $loc_pro
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom_pro', 'tel_pro', 'loc_pro'], 'required'],
            [['tel_pro', 'loc_pro'], 'integer'],
            [['nom_pro'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pro' => 'Id Pro',
            'nom_pro' => 'Nombre',
            'tel_pro' => 'Teléfono',
            'loc_pro' => 'Localidad',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProveedoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProveedoresQuery(get_called_class());
    }

    public function getlocalidades()
    {
        return $this->hasOne(Localidades::className(), ['id_loc' => 'loc_pro']);
    }
}
