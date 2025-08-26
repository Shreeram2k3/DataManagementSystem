<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Models\FacultyActivityModels\FA_X;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FA_XController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'FA_X';
        try {
            $validated = $request->validate([
            
                'date'=>'required|date',
                'name_of_faculty' => 'required|string|max:255',
                'topic' => 'required|string|max:255',
                'venue' => 'required|string|max:255',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_X', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            FA_X::create([
                'Date' => $validated['date'],
                'Name_of_Faculty' => $validated['name_of_faculty'],
                'Topic' => $validated['topic'],
                'Venue(where_delivered)'=>$validated['venue'],
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
            $record = FA_X::findOrFail($id);

            // Validate input
            $request->validate([
                
                'date'=>'required|date',
                'name_of_faculty' => 'required|string|max:255',
                'topic' => 'required|string|max:255',
                'venue' => 'required|string|max:255',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record['Date'] = $request->input('date');
            $record['Name_of_Faculty'] = $request->input('name_of_faculty');
            $record['Topic'] = $request->input('topic');
            $record['Venue(where_delivered)'] = $request->input('venue');
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
        $record->Document = $file->storeAs('FA_Documents/FA_X', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_X'])->with('success', 'Faculty activity updated successfull');
    }

    
}
