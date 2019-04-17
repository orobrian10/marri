<?php

namespace app\base;

use Yii;

/**
 * CustomGridForm is the model behind the filters form.
 *
 * @property metrics[].
 * @property values[].
 *
 */
class CustomGridForm extends Model
{
    public $columns;
    public $columnsWithFormats;
    public $columnsWithExportFormats;
    public $defaultColumns;
    public $lines = 10;
    public $status = ['En revisión', 'Aprobada', 'Rechazada', 'Vencida', 'Archivada'];
    public $page = 1;
    public $sort;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['columns', 'lines', 'status', 'page', 'sort'], 'safe'],
        ];
    }

    public function formName()
    {
        return 'g';
    }

    public function loadColumnsFormats($searchModel)
    {
        $this->columnsWithFormats = $searchModel->loadColumnsFormats($this->columns);
        $this->columnsWithExportFormats = $searchModel->loadColumnsExportFormats($this->columns);
    }
}
