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
    function viewDatapage(Request $request, $type)
    {

         $perPage = $request->input('per_page', 25);

        $validTypes = [
            'SA_I', 'SA_II', 'SA_III', 'SA_IV', 'SA_V',
            'SA_VI', 'SA_VII', 'SA_VIII', 'SA_IX', 'SA_X',
            'SA_XI', 'SA_XII', 'SA_XIII', 'SA_XIV', 'SA_XV',

            'FA_I','FA_II','FA_III','FA_IV','FA_V',
            'FA_VI','FA_VII','FA_VIII','FA_IX','FA_X',
            'FA_XI','FA_XII','FA_XIII','FA_XIV','FA_XV',
            'FA_XVI','FA_XVII','FA_XVIII','FA_XIX','FA_XX',
            'FA_XXI','FA_XXII',

            'DA_I','DA_II','DA_III','DA_IV','DA_V',
            'DA_VI','DA_VII','DA_VIII','DA_IX','DA_X',
            'DA_XI'

        ];

        $modelMap = [
            'SA_I'   => SA_I::class,
            'SA_II'  => SA_II::class,
            'SA_III' => SA_III::class,
            'SA_IV'  => SA_IV::class,
            'SA_V'   => SA_V::class,
            'SA_VI'  => SA_VI::class,
            'SA_VII' => SA_VII::class,
            'SA_VIII'=> SA_VIII::class,
            'SA_IX'  => SA_IX::class,
            'SA_X'   => SA_X::class,
            'SA_XI'  => SA_XI::class,
            'SA_XII' => SA_XII::class,
            'SA_XIII'=> SA_XIII::class,
            'SA_XIV' => SA_XIV::class,
            'SA_XV'  => SA_XV::class,

            'FA_I'    => FA_I::class,
            'FA_II'   => FA_II::class,
            'FA_III'  => FA_III::class,
            'FA_IV'   => FA_IV::class,
            'FA_V'    => FA_V::class,
            'FA_VI'   => FA_VI::class,
            'FA_VII'  => FA_VII::class,
            'FA_VIII' => FA_VIII::class,
            'FA_IX'   => FA_IX::class,
            'FA_X'    => FA_X::class,
            'FA_XI'   => FA_XI::class,
            'FA_XII'  => FA_XII::class,
            'FA_XIII' => FA_XIII::class,
            'FA_XIV'  => FA_XIV::class,
            'FA_XV'   => FA_XV::class,
            'FA_XVI'  => FA_XVI::class,
            'FA_XVII' => FA_XVII::class,
            'FA_XVIII'=> FA_XVIII::class,
            'FA_XIX'  => FA_XIX::class,
            'FA_XX'   => FA_XX::class,
            'FA_XXI'  => FA_XXI::class,
            'FA_XXII' => FA_XXII::class,

            'DA_I'    => DA_I::class,
            'DA_II'   => DA_II::class,
            'DA_III'  => DA_III::class,
            'DA_IV'   => DA_IV::class,
            'DA_V'    => DA_V::class,
            'DA_VI'   => DA_VI::class,
            'DA_VII'  => DA_VII::class,
            'DA_VIII' => DA_VIII::class,
            'DA_IX'   => DA_IX::class,
            'DA_X'    => DA_X::class,
            'DA_XI'   => DA_XI::class,

        ];
       $userDept = auth()->user()->department;
$model = $modelMap[$type];

$data[$type] = $model::whereHas('user', function ($query) use ($userDept) {
                        $query->where('department', $userDept);
                    })
                    ->paginate($perPage)
                    ->appends(['per_page' => $perPage]);

return view('admin.viewData', compact('type', 'data', 'perPage'));


      
    }
}
