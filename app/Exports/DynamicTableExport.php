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

    public function __construct(string $modelClass, string $sheetName)
    {
        $this->modelClass = $modelClass;
        $this->sheetName = $sheetName;
    }

    public function collection()
    {
        $data = $this->modelClass::all();

        // Replace user_id with username
        $data->transform(function ($item) {
            if (isset($item->user_id)) {
                $user = DB::table('users')->where('id', $item->user_id)->first();
                $item->user_id = $user ? $user->name : 'Unknown';
            }
            return $item;
        });

        return $data;
    }

    public function headings(): array
    {
        $table = (new $this->modelClass)->getTable();
        $columns = Schema::getColumnListing($table);

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

                // === 5. Borders (minimal, thin) ===
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
               $sheet->setCellValue("A{$footerRow}", "Generated by ESEC DMS • " . now()->setTimezone('Asia/Kolkata')->format('d M Y, H:i'));

                $sheet->mergeCells("A{$footerRow}:{$highestColumn}{$footerRow}");
                $sheet->getStyle("A{$footerRow}")->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 10,
                        'color' => ['rgb' => '666666'],
                        'name' => 'Calibri Light',
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);
            }
        ];
    }
}
