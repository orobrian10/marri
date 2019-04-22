<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campos".
 *
 * @property int $id
 * @property string $nom_campos
 * @property int $loc_campos
 * @property int $hec_tot_campos
 * @property int $hec_sem_campos
 */
class Campos extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'campos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom_campos', 'loc_campos', 'hec_tot_campos', 'hec_sem_campos'], 'required'],
            [['loc_campos', 'hec_tot_campos', 'hec_sem_campos', 'stock'], 'integer'],
            [['nom_campos'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nom_campos' => Yii::t('app', 'Nombre'),
            'loc_campos' => Yii::t('app', 'Localidad'),
            'hec_tot_campos' => Yii::t('app', 'Hectáreas totales'),
            'hec_sem_campos' => Yii::t('app', 'Hectáreas a sembrar'),
            'stock' => Yii::t('app', 'Stock (qq)'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CamposQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CamposQuery(get_called_class());
    }

    public function getlocalidades()
    {
        return $this->hasOne(Localidades::className(), ['id_loc' => 'loc_campos']);
    }
}
