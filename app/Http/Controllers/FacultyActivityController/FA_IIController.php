<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Models\FacultyActivityModels\FA_II;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FA_IIController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'FA_II';
        try {
            $validated = $request->validate([
            
                'name_of_the_faculty' => 'required|string|max:255',
                'id' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'details_of_publication' => 'required|string|max:255',
                'Date' => 'required|date',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_II', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            FA_I::create([
                'Name_of_the_Faculty' => $validated['name_of_the_faculty'],
                'ID' => $validated['id'],
                'Title' => $validated['title'],
                'Details_of_publication' => $validated['details_of_publication'],
                'Date' => $validated['date'],
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
            $record = FA_II::findOrFail($id);

            // Validate input
            $request->validate([
                'name_of_the_faculty' => 'required|string|max:255',
                'id' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'details_of_publication' => 'required|string|max:255',
                'Date' => 'required|date',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Name_of_the_Faculty = $request->input('name_of_the_faculty');
            $record->ID = $request->input('id');
            $record->Title = $request->input('title');
            $record->Details_of_publication = $request->input('details_of_publication');
            $record->Date = $request->input('Date');
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
        $record->Document = $file->storeAs('FA_Documents/FA_II', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_II'])->with('success', 'Faculty activity updated successfull');
    }

    
}
