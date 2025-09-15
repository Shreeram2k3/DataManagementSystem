<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Http\Controllers\Controller;
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






use Illuminate\Http\Request;

class FAdatapageController extends Controller
{
    public function Select_form(Request $request,$type)
    {
         $perPage = $request->input('per_page', 25);

        $validTypes =[
            'FA_I','FA_II','FA_III','FA_IV','FA_V',
            'FA_VI','FA_VII','FA_VIII','FA_IX','FA_X',
            'FA_XI','FA_XII','FA_XIII','FA_XIV','FA_XV',
            'FA_XVI','FA_XVII','FA_XVIII','FA_XIX','FA_XX',
            'FA_XXI','FA_XXII',
            
        ];

    $modelMap = [
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
    return view('user.FacultyActivityViews.Facultydatapage', compact('type', 'data', 'perPage'));

    }
    //---------------destroy function-----------------------------------------------------------------------

    public function destroy($type, $id)
    {
          try{
                $modelMap = [
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
            try {
                     $modelMap = [
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
                ];
            
          
            $model = $modelMap[$type];
            $record = $model::find($id);
                          
    // Fetch the list again for table display
                            $userId = auth()->id();
                            $data[$type] = $model::where('user_id', $userId)->get();
                            return view('user.FacultyActivityViews.Facultydatapage', compact('type', 'data', 'record','perPage'));
        }
        catch (\Exception $e) {
                   dd($e->getMessage());
                }
    }
}
