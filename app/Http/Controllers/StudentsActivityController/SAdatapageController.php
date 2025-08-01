<?php

namespace App\Http\Controllers\StudentsActivityController;

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
       if (in_array($type, $validTypes)) {
           return view('user.Studentdatapage',compact('type'));
       } else {
           return "The form not exists";
       }
    }
}
