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
    protected $userDepartment;

    public function __construct(array $tables, array $tableModelMap, array $tableLabelMap, string $fromDate, string $toDate, ?string $userDepartment = null)
    {
        $this->tables = $tables;
        $this->tableModelMap = $tableModelMap;
        $this->tableLabelMap = $tableLabelMap;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->userDepartment = $userDepartment;
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->tables as $table) {
            if (isset($this->tableModelMap[$table])) {
                $sheets[] = new DynamicTableExport(
                    $this->tableModelMap[$table],
                    $this->tableLabelMap[$table] ?? $table,
                    $this->fromDate,
                    $this->toDate,
                    $this->userDepartment
                );
            }
        }
        return $sheets;
    }
}
