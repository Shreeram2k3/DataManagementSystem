<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheetsExport implements WithMultipleSheets
{
    protected $tables;
    protected $tableModelMap;
    protected $tableLabelMap;
    protected $fromDate;
    protected $toDate;

    public function __construct(array $tables, array $tableModelMap, array $tableLabelMap, string $fromDate, string $toDate)
    {
        $this->tables = $tables;
        $this->tableModelMap = $tableModelMap;
        $this->tableLabelMap = $tableLabelMap;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->tables as $table) {
            if (isset($this->tableModelMap[$table])) {
                $modelClass = $this->tableModelMap[$table];
                $sheetName = $this->tableLabelMap[$table] ?? $table;

                $sheets[] = new DynamicTableExport($modelClass, $sheetName, $this->fromDate, $this->toDate);
            }
        }

        return $sheets;
    }
}
