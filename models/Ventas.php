<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventas".
 *
 * @property int $id_ven
 * @property string $fec_ven
 * @property int $cer_ven
 * @property double $kgs_ven
 * @property double $pkg_ven
 * @property double $pto_ven
 * @property int $des_ven
 *
 * @property Cereales $cerVen
 * @property Acopios $desVen
 */
class Ventas extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ventas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fec_ven', 'cer_ven', 'kgs_ven', 'pkg_ven', 'pto_ven', 'des_ven', 'stock_ven'], 'required'],
            [['fec_ven', 'obs_ven'], 'safe'],
            [['obs_ven'], 'string', 'max' => 100],
            [['cer_ven', 'des_ven'], 'integer'],
            ['kgs_ven', 'validarStock'],
            [['kgs_ven', 'pkg_ven', 'pto_ven'], 'number'],
            [['cer_ven'], 'exist', 'skipOnError' => true, 'targetClass' => Cereales::className(), 'targetAttribute' => ['cer_ven' => 'id_cer']],
            [['des_ven'], 'exist', 'skipOnError' => true, 'targetClass' => Acopios::className(), 'targetAttribute' => ['des_ven' => 'id_aco']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ven' => Yii::t('app', 'Código de Venta'),
            'fec_ven' => Yii::t('app', 'Fecha'),
            'cer_ven' => Yii::t('app', 'Cereal'),
            'kgs_ven' => Yii::t('app', 'Kg netos'),
            'pkg_ven' => Yii::t('app', 'Precio x Kg'),
            'pto_ven' => Yii::t('app', 'Prectio Total $'),
            'des_ven' => Yii::t('app', 'Destino (Acopio)'),
            'obs_ven' => Yii::t('app', 'Observación'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCerVen()
    {
        return $this->hasOne(Cereales::className(), ['id_cer' => 'cer_ven']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesVen()
    {
        return $this->hasOne(Acopios::className(), ['id_aco' => 'des_ven']);
    }

    /**
     * {@inheritdoc}
     * @return VentasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VentasQuery(get_called_class());
    }

    public function validarStock($attribute)
    {
        if ($this->des_ven && $this->kgs_ven > 0):

            $tot = Acopios::findOne(['id_aco' => $this->des_ven]);

            if (!$this->isNewRecord):
                $kgs_anterior = Ventas::findOne(['id_ven' => $this->id_ven]);
                $kgs_anterior = $kgs_anterior->kgs_ven;
                $stockAct = $tot->stock + $kgs_anterior;
                if ($stockAct < $this->kgs_ven):
                    $this->addError($attribute, 'No hay suficiente stock');
                endif;
            else:
                if ($tot->stock < $this->kgs_ven):
                    $this->addError($attribute, 'No hay suficiente stock');
                endif;
            endif;

        endif;
    }
}
