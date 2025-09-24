<?php
namespace App\Http\Controllers;

use App\Exports\DynamicTableExport;
use App\Exports\MultipleSheetsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelExportController extends Controller
{
    public function export(Request $request)
    {
        $selectedTables = $request->input('tables'); // array of selected checkboxes
        $exports = []; // initialize empty array

        // Map table names to model classes
        $tableModelMap = [
            'student_Activity_1' => \App\Models\StudentsActivityModels\SA_I::class,
            'student_Activity_2' => \App\Models\StudentsActivityModels\SA_II::class,
            'faculty_Activity_1' => \App\Models\StudentsActivityModels\SA_III::class,
            'department_Activity_1' => \App\Models\StudentsActivityModels\SA_I::class,
        ];

        // Map table names to Excel sheet labels
        $tableLabelMap = [
            'student_Activity_1' => 'S.A.I. Department Association Activities - CEO/ Leader of the Week / Conference / Symposium / Workshop / Seminar / GL',
            'student_Activity_2' => 'S.A.II. Details of Students who Participated / Presented (National Level Event)',
            'faculty_Activity_1' => 'Faculty Activity I Label',
            'department_Activity_1' => 'Department Activity I Label',
        ];

        // Loop through selected checkboxes and create DynamicTableExport objects
        foreach ($selectedTables as $table) {
            if (isset($tableModelMap[$table])) {
                $sheetName = $tableLabelMap[$table] ?? $table; // readable label for Excel
                $exports[] = new DynamicTableExport($tableModelMap[$table], $sheetName);
            }
        }

        // Return Excel download with multiple sheets
        return Excel::download(new MultipleSheetsExport($exports), 'DMS.xlsx');
    }
}
