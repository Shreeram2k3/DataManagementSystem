<?php

namespace App\Exports;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DynamicTableExport implements FromCollection, WithTitle, WithHeadings, WithEvents
{
    protected $modelClass;
    protected $sheetName;
    protected $fromDate;
    protected $toDate;

    public function __construct(string $modelClass, string $sheetName, string $fromDate, string $toDate)
    {
        $this->modelClass = $modelClass;
        $this->sheetName = $sheetName;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function collection()
    {
        $query = $this->modelClass::query();

        // Apply date filter
        if ($this->fromDate && $this->toDate) {
            $query->whereBetween('created_at', [
                $this->fromDate . ' 00:00:00',
                $this->toDate . ' 23:59:59'
            ]);
        }

        $data = $query->get();

        $removeColumns = ['S_NO', 'created_at', 'updated_at'];

        // Transform rows
        $counter = 0;
        $data->transform(function ($item) use (&$counter, $removeColumns) {
            $counter++;

            // Remove unwanted columns
            foreach ($removeColumns as $col) {
                if (isset($item->$col)) {
                    unset($item->$col);
                }
            }

            // Replace user_id with name
            if (isset($item->user_id)) {
                $user = DB::table('users')->where('id', $item->user_id)->first();
                $item->user_id = $user ? $user->name : 'Unknown';
            }

            // Format document column as Excel HYPERLINK
            if (isset($item->document) && !empty($item->document)) {
                $folder = strtoupper($this->sheetName); // Folder name: SA_I, SA_II etc.
                $item->document = '=HYPERLINK("' . asset("storage/$folder/" . $item->document) . '","View")';
            }

            // Convert to array and prepend S_No
            $row = $item->toArray();
            return array_merge(['S_No' => $counter], $row);
        });

        return $data;
    }

    public function headings(): array
    {
        $table = (new $this->modelClass)->getTable();
        $columns = Schema::getColumnListing($table);

        // Remove unwanted columns
        $columns = array_filter($columns, function ($col) {
            return !in_array($col, ['S_NO', 'created_at', 'updated_at']);
        });

        // Add S.No as first column
        array_unshift($columns, 'S_No');

        return array_map(function ($col) {
            return $col === 'user_id' ? 'Posted By' : ucwords(str_replace('_', ' ', $col));
        }, $columns);
    }

    public function title(): string
    {
        return $this->sheetName;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $highestColumn = $sheet->getHighestColumn();
                $lastRow = $sheet->getHighestRow();

                // Sheet Title
                $sheet->insertNewRowBefore(1, 1);
                $sheet->setCellValue('A1', $this->sheetName);
                $sheet->mergeCells("A1:{$highestColumn}1");
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14, 'name' => 'Calibri'],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ]);

                // Header Styling
                $sheet->getStyle("A2:{$highestColumn}2")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '4FACFE']],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ]);

                $sheet->freezePane('A3');

                // Zebra Striping
                for ($row = 3; $row <= $lastRow; $row++) {
                    if ($row % 2 === 0) {
                        $sheet->getStyle("A{$row}:{$highestColumn}{$row}")
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setRGB('F9FCFF');
                    }
                }

                // Auto-size columns
                foreach (range('A', $highestColumn) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }
}
