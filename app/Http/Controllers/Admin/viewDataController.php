<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\StudentsActivityModels\SA_I;
use App\Models\StudentsActivityModels\SA_II;
use App\Models\StudentsActivityModels\SA_III;
use App\Models\StudentsActivityModels\SA_IV;
use App\Models\StudentsActivityModels\SA_V;
use App\Models\StudentsActivityModels\SA_VI;
use App\Models\StudentsActivityModels\SA_VII;
use App\Models\StudentsActivityModels\SA_VIII;
use App\Models\StudentsActivityModels\SA_IX;
use App\Models\StudentsActivityModels\SA_X;
use App\Models\StudentsActivityModels\SA_XI;
use App\Models\StudentsActivityModels\SA_XII;
use App\Models\StudentsActivityModels\SA_XIII;
use App\Models\StudentsActivityModels\SA_XIV;
use App\Models\StudentsActivityModels\SA_XV;

use App\Models\FacultyActivityModels\FA_I;
use App\Models\FacultyActivityModels\FA_II;
use App\Models\FacultyActivityModels\FA_III;
use App\Models\FacultyActivityModels\FA_IV;
use App\Models\FacultyActivityModels\FA_V;
use App\Models\FacultyActivityModels\FA_VI;
use App\Models\FacultyActivityModels\FA_VII;
use App\Models\FacultyActivityModels\FA_VIII;
use App\Models\FacultyActivityModels\FA_IX;
use App\Models\FacultyActivityModels\FA_X;
use App\Models\FacultyActivityModels\FA_XI;
use App\Models\FacultyActivityModels\FA_XII;
use App\Models\FacultyActivityModels\FA_XIII;
use App\Models\FacultyActivityModels\FA_XIV;
use App\Models\FacultyActivityModels\FA_XV;
use App\Models\FacultyActivityModels\FA_XVI;
use App\Models\FacultyActivityModels\FA_XVII;
use App\Models\FacultyActivityModels\FA_XVIII;
use App\Models\FacultyActivityModels\FA_XIX;
use App\Models\FacultyActivityModels\FA_XX;
use App\Models\FacultyActivityModels\FA_XXI;
use App\Models\FacultyActivityModels\FA_XXII;


use App\Models\DepartmentActivityModels\DA_I;
use App\Models\DepartmentActivityModels\DA_II;
use App\Models\DepartmentActivityModels\DA_III;
use App\Models\DepartmentActivityModels\DA_IV;
use App\Models\DepartmentActivityModels\DA_V;
use App\Models\DepartmentActivityModels\DA_VI;
use App\Models\DepartmentActivityModels\DA_VII;
use App\Models\DepartmentActivityModels\DA_VIII;
use App\Models\DepartmentActivityModels\DA_IX;
use App\Models\DepartmentActivityModels\DA_X;
use App\Models\DepartmentActivityModels\DA_XI;



class viewDataController extends Controller
{
    function viewDatapage()
    {
        return view('admin.viewData');
    }
}
