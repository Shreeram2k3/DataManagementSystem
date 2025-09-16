<?php

namespace App\Http\Controllers\StudentsActivityController;
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
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SAdatapageController extends Controller
{
     public function Select_form(Request $request, $type)
{
    $perPage = $request->input('per_page', 25);

    $validTypes = [
        'SA_I', 'SA_II', 'SA_III', 'SA_IV', 'SA_V',
        'SA_VI', 'SA_VII', 'SA_VIII', 'SA_IX', 'SA_X',
        'SA_XI', 'SA_XII', 'SA_XIII', 'SA_XIV', 'SA_XV',
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
    return view('user.StudentActivityViews.Studentdatapage', compact('type', 'data', 'perPage'));
}

    //---------------destroy function-----------------------------------------------------------------------
    public function destroy($type, $id)
    {
                    try {
                    $modelMap = [
                    'SA_I' => SA_I::class,
                    'SA_II' => SA_II::class,
                    'SA_III' => SA_III::class,
                    'SA_IV' => SA_IV::class,
                    'SA_V' => SA_V::class,
                    'SA_VI' => SA_VI::class,
                    'SA_VII' => SA_VII::class,
                    'SA_VIII' =>SA_VIII::class,
                    'SA_IX' =>SA_IX::class,
                    'SA_X' =>SA_X::class,
                    'SA_XI' =>SA_XI::class,
                    'SA_XII' =>SA_XII::class,
                    'SA_XIII' =>SA_XIII::class,
                    'SA_XIV' =>SA_XIV::class,
                    'SA_XV' =>SA_XV::class,
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
        public function edit(Request $request, $type, $id)
        {               
             $perPage = $request->input('per_page', 25);
            try {
                            $modelMap = [
                                'SA_I' => SA_I::class,
                                'SA_II' => SA_II::class,
                                'SA_III' => SA_III::class,
                                'SA_IV'  =>SA_IV::class,
                                'SA_V' =>SA_V::class,
                                'SA_VI' =>SA_VI::class,
                                'SA_VII' =>SA_VII::class,
                                'SA_VIII'=>SA_VIII::class,
                                'SA_IX' =>SA_IX::class,
                                'SA_X' =>SA_X::class,
                                'SA_XI' =>SA_XI::class,
                                'SA_XII' =>SA_XII::class,
                                'SA_XIII' =>SA_XIII::class,
                                'SA_XIV'  =>SA_XIV::class,
                                'SA_XV'  =>SA_XV::class,
                            ];

                            

                            $model = $modelMap[$type];
                            $record = $model::find($id);
                          
    // Fetch the list again for table display
                            $userId = auth()->id();
                            // $data[$type] = $model::where('user_id', $userId)->get();
                             $data[$type] = $model::where('user_id', $userId)
                        ->paginate($perPage)
                        ->appends(['per_page' => $perPage]);
                            return view('user.StudentActivityViews.Studentdatapage', compact('type', 'data', 'record','perPage'));
        }
        catch (\Exception $e) {
                   dd($e->getMessage());
                }
    }
   
      

        

}
