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
            'Speaker_details' => 'required|string|max:255',
            'Coordinator' => 'required|string|max:255',
            'Duration' => 'required|string|max:50',
            'Dept' => 'required|string|max:100',
            'Outcome' => 'required|string|max:255',
            'CAMPUS_Document_ID' => 'nullable|string|max:255'
        ]);
        $request['user_id'] = auth()->id();
       //it not work due to auth for user id
       // SA_III::Create($request->all());
        //dd($request->all());
        try{
            SA_III::create([
                'Date' => $request->Date,
                'Name_of_programme' => $request->Name_of_programme,
                'Speaker_details/Convener&details' => $request->Speaker_details,
                'Coordinator' => $request->Coordinator,
                'Duration' => $request->Duration,
                'Dept' => $request->Dept,
                'Outcome' => $request->Outcome,
                'CAMPUS_Document_ID' => $request->CAMPUS_Document_ID,
                'user_id' => $request['user_id']
            ]);     
        return redirect(route('SA.view', ['type' => 'SA_III']))->with('success', 'Student activity created successfully.');
       
         } catch (\Exception $e) 
         {
           dd($e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Failed to store activity: '.$e->getMessage());
         }
        }
 catch (\Exception $e) {
    dd($e->getMessage());
           return redirect()->route('dashboard')->with('error', 'Failed to store activity: ');
        }
    
    }
}