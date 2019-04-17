<?php

namespace app\base;

use Yii;

interface SearchInterface
{
    public function search($filtersForm, $page, $linesPerPage, $status, $sort);
    public function getColumns();
    public function getDefaultColumns();
    public function getMetricValues($metric);
    public function loadColumnsFormats($columns);
    public function loadColumnsExportFormats($columns);
}