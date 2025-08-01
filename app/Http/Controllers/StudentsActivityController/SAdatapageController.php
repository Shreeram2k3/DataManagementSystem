<?php

namespace App\Http\Controllers\StudentsActivityController;
use App\Models\StudentsActivityModels\SA_I;
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
       if (in_array($type, $validTypes)) {
           return view('user.Studentdatapage',compact('type','data'));
       } else {
           return "The form not exists";
       }
    }
}
