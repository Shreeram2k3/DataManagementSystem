<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Models\FacultyActivityModels\FA_V;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FA_VController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'FA_V';
        try {
            $validated = $request->validate([
            
                'organizer_name_details' => 'required|string|max:255',
                'nature_of_seminar_conference' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'total_number_of_participants_papers'=>'required|string|max:255',
                'date' => 'required|date',
                'dept'=>'required|string|max:255',
                'outcome' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_V', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            FA_V::create([
                'Organizer_Name_Details' => $validated['organizer_name_details'],
                'Nature_of_Seminar/Conference' => $validated['nature_of_seminar_conference'],
                'Title' => $validated['title'],
                'Total_Number_of_Participants/Papers' => $validated['total_number_of_participants_papers'],
                'Date' => $validated['date'],
                'Dept'=>$validated['dept'],
                'Outcome' => $validated['outcome'],
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
            $record = FA_V::findOrFail($id);

            // Validate input
            $request->validate([
                 'organizer_name_details' => 'required|string|max:255',
                'nature_of_seminar_conference' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'total_number_of_participants_papers'=>'required|string|max:255',
                'date' => 'required|date',
                'dept'=>'required|string|max:255',
                'outcome' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Organizer_Name_Details = $request->input('organizer_name_details');
            $record['Nature_of_Seminar/Conference'] = $request->input('nature_of_seminar_conference');
            $record->Title = $request->input('title');
            $record['Total_Number_of_Participants/Papers'] = $request->input('total_number_of_participants_papers');
            $record->Date = $request->input('date');
            $record['Dept'] = $request->input('dept');
            $record->Outcome=$request->input('outcome');

            $record->document_link = $request->input('document_link');
            

            // If a new document is uploaded
    if ($request->hasFile('document')) {
        // Delete old file if exists
        if ($record->Document && Storage::disk('public')->exists($record->Document)) {
            Storage::disk('public')->delete($record->Document);
        }

        // Save new file
        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $record->Document = $file->storeAs('FA_Documents/FA_V', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_V'])->with('success', 'Faculty activity updated successfull');
    }

    
}
