<?php

namespace App\Http\Controllers\StudentsActivityController;
use App\Models\StudentsActivityModels\SA_I;
use App\Models\StudentsActivityModels\SA_II;
use App\Models\StudentsActivityModels\SA_III;
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
// ---------------------------------------------------------------------------------------------------------------
         // Check if the type is valid and return the corresponding view
       if (in_array($type, $validTypes)) {
           return view('user.Studentdatapage',compact('type','data'));
       } else {
           return "The form not exists";
       }
    }
}
