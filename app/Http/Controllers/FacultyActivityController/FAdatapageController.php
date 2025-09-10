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
}
