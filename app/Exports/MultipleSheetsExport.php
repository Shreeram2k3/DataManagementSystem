<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheetsExport implements WithMultipleSheets
{
    protected $exports;

    public function __construct(array $exports)
    {
        $this->exports = $exports;
    }

    public function sheets(): array
    {
        return $this->exports; // return all sheet exports
    }
}
