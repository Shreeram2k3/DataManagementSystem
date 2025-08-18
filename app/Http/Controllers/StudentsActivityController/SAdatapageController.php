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
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SAdatapageController extends Controller
{
     public function Select_form($type)
    {
       // to ckeck that the given type is consist of that type
       $validTypes = [
            'SA_I',
            'SA_II',
            'SA_III',
            'SA_IV',
            'SA_V',
            'SA_VI',
            'SA_VII',
            'SA_VIII',
            'SA_IX',
            'SA_X',
            'SA_XI',
             
       ];
       // Get the user ID from the authenticated user
       $userId = auth()->id();
       if ($type === 'SA_I')  
                { 
                    $data['SA_I'] = SA_I::where('user_id', $userId)->get();
                }
         else if ($type === 'SA_II')  
                {
                    $data['SA_II'] = SA_II::where('user_id', $userId)->get();
                }
         else if ($type === 'SA_III')  
                {
                    $data['SA_III'] = SA_III::where('user_id', $userId)->get();
                }
         else if ($type === 'SA_IV')  
                {
                    $data['SA_IV'] = SA_IV::where('user_id', $userId)->get();
                }
         else if($type === 'SA_V')
               {
                   $data['SA_V'] =SA_V::where('user_id',$userId)->get();
               }
         else if($type === 'SA_VI')
               {
                   $data['SA_VI'] =SA_VI::where('user_id',$userId)->get();
               }
         else if($type === 'SA_VII')
               {
                   $data['SA_VII'] =SA_VII::where('user_id',$userId)->get();
               }
         else if($type === 'SA_VIII')
                {
                    $data['SA_VIII']=SA_VIII::where('user_id',$userId)->get();
                }
         else if($type === 'SA_IX')
                {
                    $data['SA_IX']=SA_IX::where('user_id',$userId)->get();
                }
         else if($type === 'SA_X')
                {
                    $data['SA_X']=SA_X::where('user_id',$userId)->get();
                }
         else if($type === 'SA_XI')
                {
                    $data['SA_XI']=SA_XI::where('user_id',$userId)->get();
                }
                            
// -----------------------------------------------------------------------------------------------------------------
         // Check if the type is valid and return the corresponding view
                if (in_array($type, $validTypes)) {
                    return view('user.StudentActivityViews.Studentdatapage',compact('type','data'));
                } else {
                    return "The form not exists...";
                }
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
                            ];

                            

                            $model = $modelMap[$type];
                            $record = $model::find($id);
                          
    // Fetch the list again for table display
                            $userId = auth()->id();
                            $data[$type] = $model::where('user_id', $userId)->get();
                            return view('user.StudentActivityViews.Studentdatapage', compact('type', 'data', 'record'));
        }
        catch (\Exception $e) {
                   dd($e->getMessage());
                }
    }
   
      

        

}
