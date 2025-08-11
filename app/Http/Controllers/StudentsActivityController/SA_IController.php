<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Models\StudentsActivityModels\SA_I;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class SA_IController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'SA_I';
        try {
            $validated = $request->validate([
                'date' => 'required|date',
                'name_of_programme' => 'required|string|max:255',
                'speaker_details' => 'required|string|max:255',
                'topic' => 'required|string|max:255',
                'outcome' => 'required|string|max:255',
                'students_participated' => 'required|integer|min:0',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('SA_Documents/SA_I', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            SA_I::create([
                'date' => $validated['date'],
                'name_of_programme' => $validated['name_of_programme'],
                'speaker_details' => $validated['speaker_details'],
                'topic' => $validated['topic'],
                'outcome' => $validated['outcome'],
                'students_participated' => $validated['students_participated'],
                'document_link' => $validated['document_link'],
                'Document'=>$validated['document'],
                
                
                'user_id' => $validated['user_id']
            ]);
           return back()->with('success', 'Student activity created successfully.');

            // return redirect( route('SA.view', ['type' => $type]))->with('success', 'Student activity created successfully.');
           }
              catch (\Exception $e) {
                   dd($e->getMessage());
                }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create student activity: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
            $record = SA_I::findOrFail($id);

            // Validate input
            $request->validate([
                'date' => 'required|date',
                'name_of_programme' => 'required|string|max:255',
                'speaker_details' => 'required|string|max:255',
                'topic' => 'required|string|max:255',
                'outcome' => 'required|string|max:255',
                'students_participated' => 'required|integer|min:0',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->date = $request->input('date');
            $record->name_of_programme = $request->input('name_of_programme');
            $record->speaker_details = $request->input('speaker_details');
            $record->topic = $request->input('topic');
            $record->outcome = $request->input('outcome');
            $record->students_participated = $request->input('students_participated');
            $record->document_link = $request->input('document_link');
            

           // Handle file upload only if new file is uploaded
            if ($request->hasFile('document')) {
                // Delete old file if exists
                if ($record->Document && Storage::disk('public')->exists($record->Document)) {
                    Storage::disk('public')->delete($record->Document);
                }

                // Store new file
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName();
                $record->Document = $file->storeAs('SA_Documents/SA_I', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }

            $record->save();

            return redirect()->route('SA.view', ['type' => 'SA_I'])->with('success', 'Student activity updated successfull');
    }

    
}
