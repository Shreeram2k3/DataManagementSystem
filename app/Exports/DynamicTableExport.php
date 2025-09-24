<?php
namespace App\Exports;

use Illuminate\Database\Eloquent\Model;
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
        return $this->modelClass::all();
    }

    public function title(): string
    {
        return $this->sheetName;
    }

    public function headings(): array
    {
        $firstRow = $this->modelClass::first();
        if ($firstRow) {
            // Make headings readable: replace underscores, capitalize words
            return array_map(function($column){
                return ucwords(str_replace('_', ' ', $column));
            }, array_keys($firstRow->getAttributes()));
        }
        return [];
    }

    
    public function registerEvents(): array
{
    return [
        AfterSheet::class => function(AfterSheet $event) {

            // === 1. Insert table name at the top ===
            $event->sheet->insertNewRowBefore(1, 1);
            $event->sheet->setCellValue('A1', strtoupper($this->sheetName));

            $highestColumn = $event->sheet->getHighestColumn();
            $event->sheet->mergeCells("A1:{$highestColumn}1");

            // Style table name
            $event->sheet->getStyle('A1')->getFont()
                ->setBold(true)
                ->setSize(16)
                ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));
            $event->sheet->getStyle('A1')->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $event->sheet->getStyle('A1')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB('4F81BD'); // dark blue background

            // === 2. Style header row ===
            $event->sheet->getStyle('A2:' . $highestColumn . '2')->getFont()->setBold(true)->setColor(
                new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE)
            );

            $event->sheet->getStyle('A2:' . $highestColumn . '2')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setRGB('1F4E78'); // darker blue

            $event->sheet->getStyle('A2:' . $highestColumn . '2')->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // === 3. Auto-size all columns for readability ===
            foreach (range('A', $highestColumn) as $col) {
                $event->sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // === 4. Add borders to all cells ===
            $lastRow = $event->sheet->getHighestRow();
            $event->sheet->getStyle("A1:{$highestColumn}{$lastRow}")->getBorders()->getAllBorders()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
                ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK));
        }
    ];
}

    
}
