<?php

namespace App\Http\Controllers;

use App\Exports\MultipleSheetsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File;

class ExcelExportController extends Controller
{
    public function export(Request $request)
    {
        $selectedTables = $request->input('tables');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if (empty($selectedTables)) return back()->with('error', 'Choose at least one activity');
        if (!$fromDate || !$toDate) return back()->with('error', 'Please select both From and To dates');

        $tableModelMap = [
            'student_Activity_1' => \App\Models\StudentsActivityModels\SA_I::class,
            'student_Activity_2' => \App\Models\StudentsActivityModels\SA_II::class,
            'student_Activity_3' => \App\Models\StudentsActivityModels\SA_III::class,
            
        ];

        $tableLabelMap = [
            'student_Activity_1' => 'S.A.I. Department Association Activities',
            'student_Activity_2' => 'S.A.II. National Level Event',
            'student_Activity_3' => 'S.A.III. Conference / Workshop',
            
        ];

        $documentPaths = [];

        foreach ($selectedTables as $table) {
            if (!isset($tableModelMap[$table])) continue;

            $modelClass = $tableModelMap[$table];
            $docs = $modelClass::whereBetween('created_at', [$fromDate.' 00:00:00', $toDate.' 23:59:59'])
                               ->pluck('document')->toArray();

            foreach ($docs as $doc) {
                if (!empty($doc) && File::exists(storage_path('app/public/'.$doc))) {
                    // Store path with folder like SA_I, SA_II
                    $folderName = strtoupper($table);
                    $documentPaths[$folderName][] = storage_path('app/public/'.$doc);
                }
            }
        }

        $zip = new ZipArchive();
        $zipFileName = 'DMS_'.now()->format('Ymd_His').'.zip';
        $zipPath = storage_path('app/public/'.$zipFileName);

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            // Add Excel in-memory
            $multiSheetExport = new MultipleSheetsExport($selectedTables, $tableModelMap, $tableLabelMap, $fromDate, $toDate);
            $excelData = Excel::raw($multiSheetExport, \Maatwebsite\Excel\Excel::XLSX);
            $zip->addFromString('DMS.xlsx', $excelData);

            // Add documents in folders per activity
            foreach ($documentPaths as $folder => $files) {
                foreach ($files as $file) {
                    $zip->addFile($file, $folder.'/'.basename($file));
                }
            }

            $zip->close();
        } else return back()->with('error', 'Failed to create ZIP');

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
