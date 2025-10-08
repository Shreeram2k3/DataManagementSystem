<?php

namespace App\Http\Controllers;

use App\Exports\MultipleSheetsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

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
      // Student Activities 
            'student_Activity_1' => \App\Models\StudentsActivityModels\SA_I::class,
            'student_Activity_2' => \App\Models\StudentsActivityModels\SA_II::class,
            'student_Activity_3' => \App\Models\StudentsActivityModels\SA_III::class,
            'student_Activity_4' => \App\Models\StudentsActivityModels\SA_IV::class,
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

            // Faculty Activities
            'faculty_Activity_1' => \App\Models\FacultyActivityModels\FA_I::class,
            'faculty_Activity_2' => \App\Models\FacultyActivityModels\FA_II::class,
            'faculty_Activity_3' => \App\Models\FacultyActivityModels\FA_III::class,
            'faculty_Activity_4' => \App\Models\FacultyActivityModels\FA_IV::class,
            'faculty_Activity_5' => \App\Models\FacultyActivityModels\FA_V::class,
            'faculty_Activity_6' => \App\Models\FacultyActivityModels\FA_VI::class,
            'faculty_Activity_7' => \App\Models\FacultyActivityModels\FA_VII::class,
            'faculty_Activity_8' => \App\Models\FacultyActivityModels\FA_VIII::class,
            'faculty_Activity_9' => \App\Models\FacultyActivityModels\FA_IX::class,
            'faculty_Activity_10' => \App\Models\FacultyActivityModels\FA_X::class,
            'faculty_Activity_11' => \App\Models\FacultyActivityModels\FA_XI::class,
            'faculty_Activity_12' => \App\Models\FacultyActivityModels\FA_XII::class,
            'faculty_Activity_13' => \App\Models\FacultyActivityModels\FA_XIII::class,
            'faculty_Activity_14' => \App\Models\FacultyActivityModels\FA_XIV::class,
            'faculty_Activity_15' => \App\Models\FacultyActivityModels\FA_XV::class,
            'faculty_Activity_16' => \App\Models\FacultyActivityModels\FA_XVI::class,
            'faculty_Activity_17' => \App\Models\FacultyActivityModels\FA_XVII::class,
            'faculty_Activity_18' => \App\Models\FacultyActivityModels\FA_XVIII::class,
            'faculty_Activity_19' => \App\Models\FacultyActivityModels\FA_XIX::class,
            'faculty_Activity_20' => \App\Models\FacultyActivityModels\FA_XX::class,
            'faculty_Activity_21' => \App\Models\FacultyActivityModels\FA_XXI::class,
            'faculty_Activity_22' => \App\Models\FacultyActivityModels\FA_XXII::class,

            // Department Activity 
            'department_Activity_1'=> \App\Models\DepartmentActivityModels\DA_I::class,
            'department_Activity_2'=> \App\Models\DepartmentActivityModels\DA_II::class,
            'department_Activity_3'=> \App\Models\DepartmentActivityModels\DA_III::class,
            'department_Activity_4'=> \App\Models\DepartmentActivityModels\DA_IV::class,
            'department_Activity_5'=> \App\Models\DepartmentActivityModels\DA_V::class,
            'department_Activity_6'=> \App\Models\DepartmentActivityModels\DA_VI::class,
            'department_Activity_7'=> \App\Models\DepartmentActivityModels\DA_VII::class,
            'department_Activity_8'=> \App\Models\DepartmentActivityModels\DA_VIII::class,
            'department_Activity_9'=> \App\Models\DepartmentActivityModels\DA_IX::class,
            'department_Activity_10'=> \App\Models\DepartmentActivityModels\DA_X::class,
            'department_Activity_11'=> \App\Models\DepartmentActivityModels\DA_XI::class,


            
        ];

        $tableLabelMap = [

            // Student Activity Excel Title 
            'student_Activity_1' => 'S.A.I. Department Association Activities - CEO/ Leader of the Week / Conference / Symposium / Workshop / Seminar / GL',
            'student_Activity_2' => 'S.A.II. Details of Students who Participated / Presented (National Level Event)',
            'student_Activity_3' => 'S.A.III. Conference / Symposium / Workshop / Seminar Attended by Students',
            'student_Activity_4' => 'S.A.IV. Details of Students Attending Online Course (NPTEL / MOOC / SWAYAM / Spoken Tutorial / Coursera / Udemy / etc.)',
            'student_Activity_5' => 'S.A.V. Student Industrial Visit / Internship / Inplant Training',
            'student_Activity_6' => 'S.A.VI. Paper Presentation by Students (Conference / Symposium / Seminar)',
            'student_Activity_7' => 'S.A.VII. Details of Students who Participated / Presented (International Level Event)',
            'student_Activity_8' => 'S.A.VIII. Details of Students Winning Prizes in Events / Competitions',
            'student_Activity_9' => 'S.A.IX. Students Attending Value Added Courses / Certificate Courses',
            'student_Activity_10' => 'S.A.X. Details of Students Receiving Scholarships / Awards',
            'student_Activity_11' => 'S.A.XI. Student Startup / Entrepreneurship / Innovation Activities',
            'student_Activity_12' => 'S.A.XII. Student Placement Details (On-Campus / Off-Campus)',
            'student_Activity_13' => 'S.A.XIII. Students Going for Higher Studies (GATE / GRE / TOEFL / IELTS / CAT / MAT)',
            'student_Activity_14' => 'S.A.XIV. Students Participating in Sports / NSS / NCC / YRC / RRC',
            'student_Activity_15' => 'S.A.XV. Any Other Student Activities',

            // Faculty Activity Excel Title 

            'faculty_Activity_1' => 'F. A. I (a). Publication of Papers in the Journals',
            'faculty_Activity_2' => 'F. A. I (b) Book / Chapter contribution in Publications',
            'faculty_Activity_3' => 'F. A. I (c) Patents Generated / Filed',
            'faculty_Activity_4' => 'F.A.II  Seminar / Symposium/ Conferences / Training Programmes (Less than one week) (Paper Presented / Participated)',
            'faculty_Activity_5' => 'F. A. III. International /  National / Conferences / Seminar – Organized',
            'faculty_Activity_6' => 'F. A. IV. Summer School / Winter School / FDP or SDP (at least one week) attended by Staff Members',
            'faculty_Activity_7' => 'F. A. V.  Event / Winter / Summer School Proposals Submitted / Sanctioned',
            'faculty_Activity_8' => 'F. A. VI. AICTE / ISTE Sponsored  / Faculty Development Programmes - Events Organized',
            'faculty_Activity_9' => 'F.A.VII. Details of Industrial Training Undergone by the Faculty Members',
            'faculty_Activity_10' => 'F.A.VIII. Special Lectures Delivered By Faculty Members',
            'faculty_Activity_11' => 'F. A. IX.  Non-Teaching Staff Training Programmes',
            'faculty_Activity_12' => 'F.A.X. Faculty Members Deputed for Higher Studies Undergoing / Completed:  (Specify only for the period under Report)',
            'faculty_Activity_13' => 'F.A.XI. Faculty Members Guiding Ph D Scholars',
            'faculty_Activity_14' => 'F.A.XII.  Projects Proposals Submitted / Sanctioned',
            'faculty_Activity_15' => 'F.A.XIII Details of Consultancy Services of the Department',
            'faculty_Activity_16' => 'F.A.XIV Details of MoUs signed',
            'faculty_Activity_17' => 'F.A.XV Industry visits by Faculty Member',
            'faculty_Activity_18' => 'F.A.XVI Faculty Members Received Award / Applied for Any Awards',
            'faculty_Activity_19' => 'F. A. XVII Supervisor Recognition',
            'faculty_Activity_20' => 'F.A.XVIII – IRP Visit',
            'faculty_Activity_21' => 'F. A. XIX. Faculty Recruited. Relieved',
            'faculty_Activity_22' => 'F.A.XX STAFF ACTIVITIES - OTHERS',

            // Department Activity Excel Title 
            'department_Activity_1'=> 'D. A. I. Details of New Equipment Purchased in the Department',
            'department_Activity_2'=> 'D. A. II. Equipment Failure/ Service Status in the Department',
            'department_Activity_3'=> 'D. A. III.  Departmental Library',
            'department_Activity_4'=> 'D. A. IV. VIPs  Visit / Inspection to the Department / Audit',
            'department_Activity_5'=> 'D. A. V. Newsletters Released (All)',
            'department_Activity_6'=> 'D. A. VI. Activities for Competitive Examination / Higher Education / EDC',
            'department_Activity_7'=> 'D. A. VII. Awards/ Prizes won by Students',
            'department_Activity_8'=> 'D. A. VIII. Board of Studies Meeting / PAC / DAAC / GCM / AGM',
            'department_Activity_9'=> 'D. A. IX. Department Activities Others',
            'department_Activity_10'=> 'D. A. X. Department Time Table / subject allocation / faculty work load',
            'department_Activity_11'=> 'D. A. XI. Result Analysis / Sample QP / Answer Sheet / Answer key / Remedial Class',
        ];


    $documentPaths = [];

    // Loop only for collecting documents
    foreach ($selectedTables as $table) {
        if (!isset($tableModelMap[$table])) continue;

        $modelClass = $tableModelMap[$table];
        $modelInstance = new $modelClass;

        // check if 'document' column exists
        if (Schema::hasColumn($modelInstance->getTable(), 'document')) {
            $docs = $modelClass::whereBetween('created_at', [$fromDate.' 00:00:00', $toDate.' 23:59:59'])
                               ->pluck('document')->toArray();

            foreach ($docs as $doc) {
                if (!empty($doc) && File::exists(storage_path('app/public/'.$doc))) {
                    // Use short clean folder name (ex: SA_I, DA_I)
                    $folderName = strtoupper(class_basename($modelClass));
                    $documentPaths[$folderName][] = storage_path('app/public/'.$doc);
                }
            }
        }
    }

    //Now create ZIP only once
    $zip = new ZipArchive();
    $zipFileName = 'DMS_'.now()->format('Ymd_His').'.zip';
    $zipPath = storage_path('app/public/'.$zipFileName);

    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        // Add Excel in-memory
        $multiSheetExport = new MultipleSheetsExport($selectedTables, $tableModelMap, $tableLabelMap, $fromDate, $toDate);
        $excelData = Excel::raw($multiSheetExport, \Maatwebsite\Excel\Excel::XLSX);
        $zip->addFromString('DMS.xlsx', $excelData);

        // Add documents in folders
        foreach ($documentPaths as $folder => $files) {
            foreach ($files as $file) {
                $zip->addFile($file, $folder.'/'.basename($file));
            }
        }

        $zip->close();
    } else {
        return back()->with('error', 'Failed to create ZIP');
    }

    return response()->download($zipPath)->deleteFileAfterSend(true);
}

}
