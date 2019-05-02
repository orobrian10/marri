<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;

/**
 * This is the model class for table "movimientos".
 *
 * @property int $id_mov
 * @property int $cod_mov
 * @property string $var_mov
 * @property int $cos_mov
 * @property int $fec_cos
 * @property int $can_mov
 * @property int $ori_mov
 * @property int $des_mov
 * @property int $car_mov
 * @property int $cer_mov
 * @property int $tip_mov
 *
 * @property Cereales $cerMov
 */
class Movimientos extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movimientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           /* ['can_mov', 'validarStock'],

            [['ori_mov', 'des_mov'], 'validarOrigenDestino'],*/

            [['fec_cos', 'can_mov', 'ori_mov', 'des_mov', 'cer_mov', 'car_mov', 'cos_mov'], 'required'],
            [['cos_mov'], 'string', 'max' => 100],
            [['ori_mov', 'des_mov', 'car_mov', 'cer_mov', 'stock_ant_mov'], 'integer'],
            ['can_mov', 'integer', 'min' => 1],

            ['fec_cos', 'date', 'format' => 'php:Y-m-d'],

            [['cer_mov'], 'exist', 'skipOnError' => true, 'targetClass' => Cereales::className(), 'targetAttribute' => ['cer_mov' => 'id_cer']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mov' => 'Código de Movimiento',
            'fec_cos' => 'Fecha',
            'can_mov' => 'Cantidad (qq)',
            'ori_mov' => 'Procedencia',
            'des_mov' => 'Destino',
            'car_mov' => 'N° carta de porte',
            'cer_mov' => 'Cereral',
            'cos_mov' => 'Cosecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getcereales()
    {
        return $this->hasOne(Cereales::className(), ['id_cer' => 'cer_mov']);
    }

    public function getacopios()
    {
        return $this->hasOne(Acopios::className(), ['id_aco' => 'des_mov']);
    }

    public function getlocalidades()
    {
        return $this->hasOne(Localidades::className(), ['id_loc' => 'ori_mov']);
    }

    /**
     * {@inheritdoc}
     * @return MovimientosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MovimientosQuery(get_called_class());
    }

    /*public function validarStock($attribute)
    {
        if ($this->ori_mov && $this->can_mov > 0):

            $tot = Acopios::findOne(['id_aco' => $this->ori_mov]);
            if ($this->isNewRecord):
                $this->stock_ant_mov = $tot->stock + $this->can_mov;
            endif;

            if (!$this->isNewRecord):
                $sdoAnterior = Movimientos::findOne(['id_mov' => $this->id_mov]);
                $sdoAnterior = $sdoAnterior->can_mov;
                $stockAct = $tot->stock + $sdoAnterior;
            else:
                $stockAct = $tot->stock;
            endif;
            if ($stockAct < $this->can_mov):
                $this->addError($attribute, 'No hay suficiente stock');
            endif;
        endif;
    }*/

    /*public function validarOrigenDestino($attribute)
    {
        if ($this->ori_mov && $this->des_mov):
            if ($this->ori_mov == $this->des_mov):
                $this->addError($attribute, 'Destino y Orígen no pueden ser iguales');
            endif;
        endif;
    }*/

}
