<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "localidades".
 *
 * @property int $id_loc
 * @property string $nom_loc
 */
class Localidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nom_loc'], 'required'],
            [['nom_loc'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_loc' => Yii::t('app', 'Id Loc'),
            'nom_loc' => Yii::t('app', 'Nom Loc'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LocalidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocalidadesQuery(get_called_class());
    }

    public function getLocalidades()
    {
        return $this->hasMany(Localidades::className(), ['id_loc' => 'id_loc']);
    }
}
