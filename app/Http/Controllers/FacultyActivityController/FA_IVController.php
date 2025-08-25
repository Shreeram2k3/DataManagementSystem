<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Models\FacultyActivityModels\FA_IV;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FA_IController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'FA_IV';
        try {
            $validated = $request->validate([
            
                'date' => 'required|date',
                'name_of_the_faculty_members' => 'required|string|max:255',
                'participated_presented' => 'required|string|max:255',
                'title_of_the_paper' => 'required|string|max:255',
                'page_numbers' => 'required|string|max:255',
                'programme' => 'required|string|max:255',
                'conference_symposium_training_programme_details'=>'required|string|max:255',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_IV', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            FA_IV::create([
                'Date' => $validated['date'],
                'Name_of_the_Faculty_members' => $validated['name_of_the_faculty_members'],
                'Participated_Presented' => $validated['participated_presented'],
                'Title_of_the_Paper' => $validated['title_of_the_paper'],
                'Page_Numbers' => $validated['page_numbers'],
                'Programme' => $validated['programme'],
                'conference_symposium_training_programme_details' => $validated['conference_symposium_training_programme_details'],
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
            $record = FA_IV::findOrFail($id);

            // Validate input
            $request->validate([
                 'date' => 'required|date',
                'name_of_the_faculty_members' => 'required|string|max:255',
                'participated_presented' => 'required|string|max:255',
                'title_of_the_paper' => 'required|string|max:255',
                'page_numbers' => 'required|string|max:255',
                'programme' => 'required|string|max:255',
                'conference_symposium_training_programme_details'=>'required|string|max:255',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Date = $request->input('date');
            $record->Name_of_the_Faculty_members = $request->input('name_of_the_faculty_members');
            $record->Participated_Presented = $request->input('participated_presented');
            $record->Title_of_the_Paper = $request->input('title_of_the_paper');
            $record->Page_Numbers = $request->input('page_numbers');
            $record['Programme'] = $request->input('programme');
            $record['conference_symposium_training_programme_details'] = $request->input('conference_symposium_training_programme_details');
            $record['Dept'] = $request->input('dept');

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
        $record->Document = $file->storeAs('FA_Documents/FA_IV', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_IV'])->with('success', 'Faculty activity updated successfull');
    }

    
}
