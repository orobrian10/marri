<?php

namespace app\base;

use Yii;
use yii\helpers\ArrayHelper;

class GenericSearch extends Model
{
    private $searchModel;
    private $customGridForm;
    private $filtersForm;

    public function __construct($searchModel)
    {
        $this->searchModel = $searchModel;
        $this->customGridForm = new CustomGridForm();
        $this->customGridForm->columns = $searchModel->getDefaultColumns();
        $this->filtersForm = [];
        foreach ($this->searchModel->getColumns() as $column) {
            $this->filtersForm[] = new FiltersForm();
        }
    }

    public function load($data, $formName = null)
    {
        $this->searchModel->load($data);
        $this->customGridForm->load($data);
        $this->customGridForm->loadColumnsFormats($this->searchModel);

        if (Yii::$app->request->get((new FiltersForm)->formName()) && count(Yii::$app->request->get((new FiltersForm)->formName())) > 0) {
            Model::loadMultiple($this->filtersForm, $data);



            foreach ($this->filtersForm as &$filterForm) {
                $result = $this->searchModel->getMetricValues($filterForm->metric);

                $filterForm->type = $result['type'];
                if ($filterForm->type == 'dropdown') {
                    $filterForm->allValues = ArrayHelper::map($result['values'], 'id', 'value');;
                } else {
                    $filterForm->allValues = $result['values'];
                }
            }

        }
    }

    public function search()
    {
        // Select only the FilterForm that has values
        $selectedfiltersForm = [];
        foreach ($this->filtersForm as $filterForm) {
            if ($filterForm->hasValue()){
                $selectedfiltersForm[] = $filterForm;
            }
        }
        return $this->searchModel->search($selectedfiltersForm, $this->customGridForm->page, $this->customGridForm->lines, $this->customGridForm->status, $this->customGridForm->sort);
    }

    public function getSearchModel()
    {
        return $this->searchModel;
    }

    public function getCustomGridForm()
    {
        return $this->customGridForm;
    }

    public function getFiltersForm()
    {
        return $this->filtersForm;
    }

    public function getFiltersMetrics()
    {
        return $this->searchModel->getColumns();
    }
}