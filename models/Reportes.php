<?php

namespace app\models;

use app\base\Model;
use Yii;

/**
 * This is the model class for table "cereales".
 *
 * @property int $id_cer
 * @property string $nom_cer
 * @property string $var_cer
 */
class Reportes extends Model
{

    public $fde;
    public $fha;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fde', 'fha'], 'required'],
            [['fde', 'fha'], 'date', 'format' => 'php:Y-m-d'],
            ['fde','validateDates'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fde' => 'Fecha desde',
            'fha' => 'Fecha hasta',
        ];
    }

    public function validateDates(){
        if(strtotime($this->fha) < strtotime($this->fde)){
            $this->addError('fde','No puede ser mayor a hasta');
            $this->addError('fha','No puede ser menor a desde');
        }
    }

}
