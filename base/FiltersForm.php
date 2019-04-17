<?php

namespace app\base;

use Yii;

/**
 * FiltersForm is the model behind the filters form.
 *
 * @property metrics[].
 * @property values[].
 *
 */
class FiltersForm extends Model
{
    public $metric;
    public $valueInput;
    public $valuesDropdown;
    public $allValues;
    public $type;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['metric', 'valuesDropdown', 'valueInput'], 'safe'],
        ];
    }

    public function hasValue()
    {
        return !empty($this->valuesDropdown) || $this->valueInput;
    }

    public function formName()
    {
        return 'f';
    }
}
