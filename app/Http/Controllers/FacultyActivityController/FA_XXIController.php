<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Models\FacultyActivityModels\FA_XXI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FA_XXIController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'FA_XXI';
        try {
            $validated = $request->validate([
            
                'faculty_name' => 'required|string|max:255',
                'qualification' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'recruited-relieved'=>'required|string|max:255',
                'date_of_joining-relieving'=>'required|date',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_XXI', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            FA_XXI::create([
                'Faculty_name' => $validated['faculty_name'],
                'Qualification' => $validated['qualification'],
                'Designation' => $validated['designation'],
                'Recruited/Relieved'=>$validated['recruited-relieved'],
                'Date_of_Joining/Relieving'=>$validated['date_of_joining-relieving'],
                'Dept'=>$validated['dept'],
                'Document_Link' => $validated['document_link'],
                'Document'=>$validated['document'],
                
                
                'user_id' => $validated['user_id']
            ]);
           return back()->with('success', 'Faculty activity added successfully.');

           
           }
              catch (\Exception $e) {
                   dd($e->getMessage());
                }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to add Faculty activity: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
            $record = FA_XXI::findOrFail($id);

            // Validate input
            $request->validate([
                
                'faculty_name' => 'required|string|max:255',
                'qualification' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'recruited-relieved'=>'required|string|max:255',
                'date_of_joining-relieving'=>'required|date',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record['Faculty_name'] = $request->input('faculty_name');
            $record['Qualification'] = $request->input('qualification');
            $record['Designation'] = $request->input('designation');
            $record['Recruited/Relieved'] = $request->input('recruited-relieved');
             $record['Date_of_Joining/Relieving'] = $request->input('date_of_joining-relieving');
            $record['Dept'] = $request->input('dept');  
           
            $record->Document_Link = $request->input('document_link');
            

            // If a new document is uploaded
    if ($request->hasFile('document')) {
        // Delete old file if exists
        if ($record->Document && Storage::disk('public')->exists($record->Document)) {
            Storage::disk('public')->delete($record->Document);
        }

        // Save new file
        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $record->Document = $file->storeAs('FA_Documents/FA_XXI', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_XXI'])->with('success', 'Faculty activity updated successfull');
    }

    
}
