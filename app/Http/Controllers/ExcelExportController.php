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
        try{
        $selectedTables = $request->input('tables'); // array of selected checkboxes
        $exports = []; // initialize empty array

        // Map table names to model classes
        $tableModelMap = [
            'student_Activity_1' => \App\Models\StudentsActivityModels\SA_I::class,
            'student_Activity_2' => \App\Models\StudentsActivityModels\SA_II::class,
            'student_Activity_3' => \App\Models\StudentsActivityModels\SA_III::class,
            'student_Activity_4' => \App\Models\StudentsActivityModels\SA_VI::class,
            'student_Activity_5' => \App\Models\StudentsActivityModels\SA_V::class,
            'student_Activity_6' => \App\Models\StudentsActivityModels\SA_VI::class,
            'student_Activity_7' => \App\Models\StudentsActivityModels\SA_VII::class,
            'student_Activity_8' => \App\Models\StudentsActivityModels\SA_VIII::class,
            'student_Activity_9' => \App\Models\StudentsActivityModels\SA_IX::class,
            'student_Activity_10' => \App\Models\StudentsActivityModels\SA_X::class,
            'student_Activity_11' => \App\Models\StudentsActivityModels\SA_XI::class,
            'student_Activity_12' => \App\Models\StudentsActivityModels\SA_XII::class,
            'student_Activity_13' => \App\Models\StudentsActivityModels\SA_XIII::class,
            'student_Activity_14' => \App\Models\StudentsActivityModels\SA_XIV::class,
            'student_Activity_15' => \App\Models\StudentsActivityModels\SA_XV::class,
            'faculty_Activity_15' => \App\Models\StudentsActivityModels\SA_III::class,
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
    catch (\Exception $e) {
           
            return redirect()->back()->with(['error' => 'Choose a activity  ']);
        }
    }
}
