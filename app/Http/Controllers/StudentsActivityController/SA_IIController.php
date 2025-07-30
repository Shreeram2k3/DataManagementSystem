<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use App\Models\StudentsActivityModels\SA_II;
use Illuminate\Http\Request;

class SA_IIController extends Controller
{
    //

     public function store(Request $request)
    {
        
        try {
            $validated = $request->validate([

                'Name_of_student(s)' => 'required|string|max:255',
                'Roll_No' => 'required|string|max:50',
                'class' => 'required|string|max:50',
                'Title_of_Event/Presentation' => 'required|string|max:255',
                'Venue' => 'required|string|max:255',
                'Prize/place' => 'required|string|max:255',
                'Date' => 'required|date',
                'Document_Link' => 'nullable|url'
            ]);

            //dd($validated);
            SA_II::create($request->all());
            return redirect()->route('dashboard')->with('success', 'Student activity has entered successfully!');

           
          
        } catch (\Exception $e) {
            //dd($e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Failed to store activity: ');
        }
    }
}
