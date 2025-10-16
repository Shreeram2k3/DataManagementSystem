<?php

namespace App\Exports;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;


class DynamicTableExport implements FromCollection, WithTitle, WithHeadings, WithEvents
{
    protected $modelClass;
    protected $sheetName;
    protected $fromDate;
    protected $toDate;
    protected $userDepartment;

    public function __construct(string $modelClass, string $sheetName, string $fromDate, string $toDate,string $userDepartment)
    {
        $this->modelClass = $modelClass;
        $this->sheetName  = $sheetName;
        $this->fromDate   = $fromDate;
        $this->toDate     = $toDate;
        $this->userDepartment = $userDepartment;
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
        
        if (Schema::hasColumn((new $this->modelClass)->getTable(), 'department')) {
        $query->where('department', $this->userDepartment);
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

            // Replace user_id with user name
            if (isset($item->user_id)) {
                $user = DB::table('users')->where('id', $item->user_id)->first();
                $item->user_id = $user ? $user->name : 'Unknown';
            }

            // Format document column as Excel HYPERLINK
            if (isset($item->document) && !empty($item->document)) {
                $folder = strtoupper($this->sheetName); // Folder name: SA_I, SA_II etc.
                $url = asset("storage/$folder/" . $item->document);
                $item->document = "=HYPERLINK(\"$url\",\"View\")";;
            }

            // Convert to array and prepend S_No
            $row = $item->toArray();
            return array_merge(['S_No' => $counter], $row);
        });

        return $data;
    }

    public function headings(): array
    {
        $table   = (new $this->modelClass)->getTable();
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
                $sheet        = $event->sheet;
                $highestColumn = $sheet->getHighestColumn();
                $lastRow      = $sheet->getHighestRow();

                // === 1. Title row ===
                $sheet->insertNewRowBefore(1, 1);
                $sheet->setCellValue('A1', $this->sheetName);
                $sheet->mergeCells("A1:{$highestColumn}1");
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => '1A1A1A'],
                        'name' => 'Calibri',
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $sheet->getRowDimension(1)->setRowHeight(25);

                // === 2. Header row (Crystal Gradient) ===
                $sheet->getStyle("A2:{$highestColumn}2")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => ['rgb' => 'FFFFFF'],
                        'name' => 'Segoe UI',
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'wrapText'   => true,
                    ],
                    'fill' => [
                        'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation'   => 45,
                        'startColor' => ['rgb' => '4FACFE'],
                        'endColor'   => ['rgb' => '00F2FE'],
                    ],
                ]);
                $sheet->getRowDimension(2)->setRowHeight(20);

                // === 3. Freeze header row ===
                $sheet->freezePane('A3');

                // === 4. Zebra striping ===
                for ($row = 3; $row <= $lastRow; $row++) {
                    if ($row % 2 === 0) {
                        $sheet->getStyle("A{$row}:{$highestColumn}{$row}")
                            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setRGB('F9FCFF');
                    }
                }

                // === 5. Borders ===
                $sheet->getStyle("A2:{$highestColumn}{$lastRow}")->applyFromArray([
                    'borders' => [
                        'inside' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
                            'color' => ['rgb' => 'DDDDDD'],
                        ],
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => 'AAAAAA'],
                        ],
                    ],
                ]);

                // === 6. Auto-size columns ===
                foreach (range('A', $highestColumn) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // === 7. Footer row ===
                $footerRow = $lastRow + 2;
                $sheet->setCellValue("A{$footerRow}", "Generated by ESEC DMS • " . now()->setTimezone('Asia/Kolkata')->format('d M Y, h:i A'));
                $sheet->mergeCells("A{$footerRow}:{$highestColumn}{$footerRow}");
                $sheet->getStyle("A{$footerRow}")->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size'   => 10,
                        'color'  => ['rgb' => '666666'],
                        'name'   => 'Calibri Light',
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);
            }
        ];
    }
}
