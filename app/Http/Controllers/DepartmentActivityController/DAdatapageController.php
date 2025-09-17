<?php

namespace App\Http\Controllers\DepartmentActivityController;

use App\Http\Controllers\Controller;
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



use Illuminate\Http\Request;

class DAdatapageController extends Controller
{
    public function Select_form(Request $request,$type)
    {
        $perPage = $request->input('per_page', 25);

        $validTypes =[
            'DA_I','DA_II','DA_III','DA_IV','DA_V',
            'DA_VI','DA_VII','DA_VIII','DA_IX','DA_X',
            'DA_XI'
            
        ];
        
        $modelMap = [
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

        if (!in_array($type, $validTypes)) {
            return "The form does not exist...";
        }

        $userId = auth()->id();
        $model = $modelMap[$type];

        $data[$type] = $model::where('user_id', $userId)
                            ->paginate($perPage)
                            ->appends(['per_page' => $perPage]);

        

        // First load → full page
        return view('user.DepartmentActivityViews.Departmentdatapage', compact('type', 'data', 'perPage'));

    }

 //---------------destroy function-----------------------------------------------------------------------

    public function destroy($type, $id)
    {
        try{

             $modelMap = [
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

            $modelClass = $modelMap[$type];
                $record = $modelClass::findOrFail($id);
                $record->delete();

    
                return redirect()->back()->with('delete', 'Record deleted successfully.');
        
        }

         catch (\Exception $e) {
                        dd($e->getMessage());
   
             }

    }

//---------------edit and update function-----------------------------------------------------------------------

    public function edit( Request $request,$type, $id)
    { 
        $perPage = $request->input('per_page', 25); 
        
        try
        {
             $modelMap = [
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

             $model = $modelMap[$type];
            $record = $model::find($id);
            // Fetch the list again for table display
                $userId = auth()->id();
                $data[$type] = $model::where('user_id', $userId)->paginate($perPage)
            ->appends(['per_page' => $perPage]);
                return view('user.DepartmentActivityViews.Departmentdatapage', compact('type', 'data', 'record','perPage'));

        }
         catch (\Exception $e) {
                   dd($e->getMessage());
                }
    }


}
