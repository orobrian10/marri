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

    //public $nom_des;
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
            ['can_mov', 'validarStock'],
            [['cod_mov', 'fec_cos', 'can_mov', 'ori_mov', 'tor_mov', 'tde_mov', 'des_mov', 'cer_mov', 'tip_mov'], 'required'],
            [['cod_mov', 'can_mov', 'ori_mov', 'des_mov', 'car_mov', 'cer_mov', 'tip_mov'], 'integer'],
            ['cod_mov', 'unique'],

            ['fec_cos', 'date', 'format' => 'php:Y-m-d'],

            [['cos_mov'], 'string', 'max' => 300],
            [['var_mov'], 'string', 'max' => 200],

            [['var_mov', 'cos_mov'], 'required', 'when' => function ($model) {
                return $model->tip_mov == 1 || $model->tip_mov == 2;
            }, 'whenClient' => "function (attribute, value) {
                mov = $('#movimientos-tip_mov').val();
                if(mov == 1 || mov == 2)
                    return true;
                return false;
            }"],

            [['car_mov'], 'required', 'when' => function ($model) {
                return $model->tip_mov == 2;
            }, 'whenClient' => "function (attribute, value) {
                mov = $('#movimientos-tip_mov').val();
                if(mov == 2)
                    return true;
                return false;
            }"],

            [['cer_mov'], 'exist', 'skipOnError' => true, 'targetClass' => Cereales::className(), 'targetAttribute' => ['cer_mov' => 'id_cer']],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mov' => 'Id Mov',
            'cod_mov' => 'Código de movimiento',
            'var_mov' => 'Variedad de cereal',
            'cos_mov' => 'Cosecha',
            'fec_cos' => 'Fecha de Cosecha',
            'can_mov' => 'Cantidad (qq)',
            'ori_mov' => 'Orígen',
            'des_mov' => 'Destino',
            'car_mov' => 'N° carta de porte',
            'cer_mov' => 'Cereral',
            'tip_mov' => 'Tipo de movimiento',
            'tor_mov' => 'Tipo de Orígen',
            'tde_mov' => 'Tipo de Destino'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getcereales()
    {
        return $this->hasOne(Cereales::className(), ['id_cer' => 'cer_mov']);
    }

    /**
     * {@inheritdoc}
     * @return MovimientosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MovimientosQuery(get_called_class());
    }

    public function validarStock($attribute)
    {
        if ($this->ori_mov && $this->can_mov > 0):
            if ($this->tor_mov == 1):
                $tot = Campos::findOne(['id' => $this->ori_mov]);
            else:
                $tot = Acopios::findOne(['id_aco' => $this->ori_mov]);
            endif;
            if ($tot->stock < $this->can_mov):
                $this->addError($attribute, 'No hay suficiente stock');
            endif;
        endif;
    }

}
