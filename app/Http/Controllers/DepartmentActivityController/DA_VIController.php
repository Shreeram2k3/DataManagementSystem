<?php

namespace App\Http\Controllers\DepartmentActivityController;

use App\Models\DepartmentActivityModels\DA_VI; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DA_VIController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'DA_VI';
        try {
            $validated = $request->validate([
            
                'date' => 'required|date',
                'duration' => 'required|string|max:255',
                'activity' => 'required|string|max:255',
                'speaker/organization' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('DA_Documents/DA_VI', $filename, 'public');
            }

        // dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            DA_VI::create([
                'Date' => $validated['date'],
                'Duration' => $validated['duration'],
                'Activity' => $validated['activity'],
                'Speaker/Organization' => $validated['speaker/organization'],
                'Document_Link' => $validated['document_link'],
                'Document'=>$validated['document'],
                
                
                'user_id' => $validated['user_id']
            ]);
           return back()->with('success', 'Department activity added successfully.');

           
           }
              catch (\Exception $e) {
                   dd($e->getMessage());
                }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to add Department activity: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
            $record = DA_VI::findOrFail($id);

            // Validate input
            $request->validate([
                'date' => 'required|date',
                'duration' => 'required|string|max:255',
                'activity' => 'required|string|max:255',
                'speaker/organization' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf|max:5120'
            ]);

            // Update fields
            $record->Date = $request->input('date');
            $record->Duration = $request->input('duration');
            $record->Activity = $request->input('activity');
            $record['Speaker/Organization'] = $request->input('speaker/organization');

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
        $record->Document = $file->storeAs('DA_Documents/DA_VI', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('DA.view', ['type' => 'DA_VI'])->with('success', 'Department activity updated successfully');
    }

    
}
