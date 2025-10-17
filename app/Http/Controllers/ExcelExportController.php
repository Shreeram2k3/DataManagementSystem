<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Exports\MultipleSheetsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use setasign\Fpdi\Fpdi;

class ExcelExportController extends Controller
{
    public function export(Request $request)
    {
        $selectedTables = $request->input('tables');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        if (empty($selectedTables)) {
            return back()->with('error', 'Choose at least one activity');
        }

        if (!$fromDate || !$toDate) {
            return back()->with('error', 'Please select both From and To dates');
        }

        $user = Auth::user();
        $isSuperAdmin = $user->role === 'super_admin';
        $userDepartment = $isSuperAdmin ? null : $user->department;

         $tableModelMap = [
            // Student Activities
            'student_Activity_1' => \App\Models\StudentsActivityModels\SA_I::class,
            'student_Activity_2' => \App\Models\StudentsActivityModels\SA_II::class,
        ];

        $tableLabelMap = [
            'student_Activity_1' => 'S.A.I. Department Association Activities',
            'student_Activity_2' => 'S.A.II. Details of Students who Participated',
        ];


        $documentPaths = [];

        // === FETCH DOCUMENTS ===
        foreach ($selectedTables as $table) {
            if (!isset($tableModelMap[$table])) continue;

            $modelClass = $tableModelMap[$table];
            $modelInstance = new $modelClass;

            if (Schema::hasColumn($modelInstance->getTable(), 'document')) {

                $query = $modelClass::query()
                    ->whereNotNull('document')
                    ->whereBetween('created_at', [$fromDate . ' 00:00:00', $toDate . ' 23:59:59']);

                if (!$isSuperAdmin) {
                    $query->whereHas('user', function ($q) use ($userDepartment) {
                        $q->whereRaw('LOWER(department) = ?', [strtolower($userDepartment)]);
                    });
                }

                $docs = $query->pluck('document')->filter()->toArray();

                foreach ($docs as $doc) {
                    $fullPath = storage_path('app/public/' . $doc);
                    if (File::exists($fullPath)) {
                        $folderName = strtoupper(class_basename($modelClass));
                        $documentPaths[$folderName][] = $fullPath;
                    }
                }
            }
        }

        // === CREATE ZIP ===
        $zipFolder = storage_path('app/public');
        if (!File::exists($zipFolder)) {
            File::makeDirectory($zipFolder, 0777, true);
        }

        $zipFileName = 'DMS_' . now()->format('Ymd_His') . '.zip';
        $zipPath = $zipFolder . DIRECTORY_SEPARATOR . $zipFileName;

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            return back()->with('error', 'Failed to create ZIP file. Check folder permissions.');
        }

        // === ADD EXCEL TO ZIP ===
        $multiSheetExport = new MultipleSheetsExport(
            $selectedTables,
            $tableModelMap,
            $tableLabelMap,
            $fromDate,
            $toDate,
            $userDepartment
        );

        $excelData = Excel::raw($multiSheetExport, \Maatwebsite\Excel\Excel::XLSX);
        $zip->addFromString('DMS.xlsx', $excelData);

        $tempFiles = []; // track temporary PDF files

        // === MERGE PDFs ===
        foreach ($documentPaths as $folder => $files) {
            if (count($files) === 0) continue;

            $mergedPdfPath = storage_path("app/temp_{$folder}_" . uniqid() . ".pdf");
            $pdf = new Fpdi();

            foreach ($files as $file) {
                $compatiblePdf = storage_path("app/temp_compatible_" . uniqid() . "_" . basename($file));

                // Convert PDF using Ghostscript
                $gsCommand = sprintf(
                    'gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/prepress -dNOPAUSE -dBATCH -sOutputFile=%s %s',
                    escapeshellarg($compatiblePdf),
                    escapeshellarg($file)
                );
                exec($gsCommand, $output, $returnVar);

                if ($returnVar !== 0 || !File::exists($compatiblePdf)) {
                    continue; // skip this file if conversion fails
                }

                $tempFiles[] = $compatiblePdf;

                $pageCount = $pdf->setSourceFile($compatiblePdf);
                for ($page = 1; $page <= $pageCount; $page++) {
                    $tplIdx = $pdf->importPage($page);
                    $size = $pdf->getTemplateSize($tplIdx);
                    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                    $pdf->useTemplate($tplIdx);
                }
            }

            $pdf->Output($mergedPdfPath, 'F');
            $zip->addFile(
                $mergedPdfPath,
                $folder . '/Merged_' . $folder . '_Docs_' . now()->format('Ymd_His') . '.pdf'
            );

            $tempFiles[] = $mergedPdfPath;
        }

        $zip->close();

        // === CLEAN UP TEMP FILES ===
        foreach ($tempFiles as $tempFile) {
            if (File::exists($tempFile)) {
                File::delete($tempFile);
            }
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
