<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Models\FacultyActivityModels\FA_I;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FA_IIIController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'FA_III';
        try {
            $validated = $request->validate([
            
                'faculty_member' => 'required|string|max:255',
                'title_of_the_invention' => 'required|string|max:255',
                'sponsoring_agency' => 'required|string|max:255',
                'registration_details' => 'required|string|max:255',
                'national_international' => 'required|string|max:255',
                'date' => 'required|date|max:255',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_III', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            FA_III::create([
                'Faculty_Member' => $validated['faculty_member'],

                'Title_of_the_Invention' => $validated['title_of_the_invention'],

                'Sponsoring_Agency' => $validated['sponsoring_agency'],

                'Registration_Details' => $validated['registration_details'],
                
                'National_International' => $validated['national_international'],

                'Date' => $validated['date'],
                
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
            $record = FA_III::findOrFail($id);

            // Validate input
            $request->validate([
                'faculty_member' => 'required|string|max:255',
                'title_of_the_invention' => 'required|string|max:255',
                'sponsoring_agency' => 'required|string|max:255',
                'registration_details' => 'required|string|max:255',
                'national_international' => 'required|string|max:255',
                'date' => 'required|date|max:255',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Faculty_Member = $request->input('faculty_member');
            $record->Title_of_the_Invention = $request->input('title_of_the_invention');
            $record->Sponsoring_Agency = $request->input('sponsoring_agency');
            $record->Registration_Details = $request->input('registration_details');
            $record->National_International = $request->input('national_international');
            $record['Date'] = $request->input('date');
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
        $record->Document = $file->storeAs('FA_Documents/FA_III', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_III'])->with('success', 'Faculty activity updated successfull');
    }

    
}
