<?php

namespace App\Http\Controllers\StudentsActivityController;
use App\Models\StudentsActivityModels\SA_III;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SA_IIIController extends Controller
{
    public function store(Request $request)
    {
        try{

        $request->validate([
            'Date' => 'required|date',
            'Name_of_programme' => 'required|string|max:255',
            'Speaker_details/Convener&details' => 'required|string|max:255',
            'Coordinator' => 'required|string|max:255',
            'Duration' => 'required|string|max:50',
            'Dept' => 'required|string|max:100',
            'Outcome' => 'required|string|max:255',
            'CAMPUS_Document_ID' => 'nullable|string|max:255', 
        ]);
       
        SA_III::Create($request->all());
        //  dd($request->all());
        return redirect()->route('dashboard')->with('success', 'Student activity has been entered successfully');
       
    }
 catch (\Exception $e) {
    dd($e->getMessage());
           return redirect()->route('dashboard')->with('error', 'Failed to store activity: ');
        }
    }
}
