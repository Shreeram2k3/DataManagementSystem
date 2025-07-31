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
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();

            //dd($validated);
            try{
                SA_II::create([
                    'Name_of_student(s)' => $validated['Name_of_student(s)'],
                    'Roll_No' => $validated['Roll_No'],
                    'class' => $validated['class'],
                    'Title_of_Event/Presentation' => $validated['Title_of_Event/Presentation'],
                    'Venue' => $validated['Venue'],
                    'Prize/place' => $validated['Prize/place'],
                    'Date' => $validated['Date'],
                    'Document_Link' => $validated['Document_Link'],
                    'user_id' => $validated['user_id']
                ]);
                return redirect()->route('dashboard')->with('success', 'Student activity has entered successfully!');
            } 
            catch (\Exception $e) {
                // Handle the exception
                return redirect()->route('dashboard')->with('error', 'Failed to store activity: '.$e->getMessage());
            }

           
          
        } catch (\Exception $e) {
            //dd($e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Failed to store activity: ');
        }
    }
}
