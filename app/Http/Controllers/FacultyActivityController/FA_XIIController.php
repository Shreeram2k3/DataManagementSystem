<?php

namespace App\Http\Controllers\FacultyActivityController;
use App\Models\FacultyActivityModels\FA_XII;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FA_XIIController extends Controller
{
    public function store(Request $request)
    {
        $type='SA_XII';
        try{
            $validate=$request->validate([
                'name_of_staff' => 'required|string|max:255',
                'programme_of_study' => 'required|string|max:255',
                'name_of_institute_&_university' => 'required|string|max:255',
                'date_of_admission_completed' => 'required|date',
                'outcome' => 'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);

            $validated['user_id'] = auth()->id();
              if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_XII', $filename, 'public');
            }
            try{

            // left side column name in table, right side name attribute in form 
            FA_XII::create([
                'Name_of_Staff' => $validated['name_of_staff'],
                'Programme_of_study' => $validate['programme_of_study'],
                'Name_of_Institute_&_University' => $validate['name_of_institute_&_university'],
                'Date_of_Admission_Completed' => $validate['date_of_admission_completed'],
                'Outcome' => $validate['outcome'],
                'Dept' => $validate['dept'],
                'Document_Link' => $validated['document_link'],
                'Document'=>$validated['document'],
                
                
                'user_id' => $validated['user_id']
            ]);
           return back()->with('success', 'Faculty  activity added successfully.');

           
           }
              catch (\Exception $e) {
                   dd($e->getMessage());
                }

        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create student activity: ' . $e->getMessage()]);
        }
    }

    //---------------- ----------------------------------

    public function update(Request $request, $id)
    {
            $record = FA_XII::findOrFail($id);

            // Validate input
            $validate=$request->validate([
                'name_of_staff' => 'required|string|max:255',
                'programme_of_study' => 'required|string|max:255',
                'name_of_institute_&_university' => 'required|string|  max:255',
                'date_of_admission_completed' => 'required|date',
                'outcome' => 'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Name_of_Staff = $request->input('name_of_staff');
            $record->Programme_of_study = $request->input('programme_of_study');
            $record['Name_of_Institute_&_University'] = $request->input('name_of_institute_&_university');
            $record->Date_of_Admission_Completed = $request->input('date_of_admission_completed');
            $record->Outcome = $request->input('outcome');
            $record->Dept = $request->input('dept');
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
        $record->Document = $file->storeAs('FA_Documents/FA_XII', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_XII'])->with('success', 'Faculty activity updated successfull');
    }
}

