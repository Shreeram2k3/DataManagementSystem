<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Http\Controllers\Controller;
use App\Models\FacultyActivityModels\FA_I;
use Illuminate\Http\Request;

class FAdatapageController extends Controller
{
    public function Select_form($type)
    {
        $validTypes =[
            'FA_I',
            'FA_II',
        ];

      $userId=auth()->id();
      if($type === 'FA_I' )
      {
        $data['FA_I']=FA_I::where('user_id',$userId)->get();
      }

    //   ---------------------------------------------------------
         // Check if the type is valid 
         if(in_array($type,$validTypes)){
            return view('user.FacultyActivityViews.Facultydatapage',compact('type','data'));
         }
         else{
            return "Form not exists....";
         }

    }
    //---------------destroy function-----------------------------------------------------------------------

    public function destroy($type, $id)
    {
          try{
                $modelMap=[
                      'FA_I'=>FA_I::class,
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
        public function edit($type, $id)
        {               
            try {
                      $modelMap=[
                          'FA_I' => FA_I::class,
                      ];
            
          
            $model = $modelMap[$type];
            $record = $model::find($id);
                          
    // Fetch the list again for table display
                            $userId = auth()->id();
                            $data[$type] = $model::where('user_id', $userId)->get();
                            return view('user.FacultyActivityViews.Facultydatapage', compact('type', 'data', 'record'));
        }
        catch (\Exception $e) {
                   dd($e->getMessage());
                }
    }
}
