<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_IV;

class SA_IVController extends Controller
{
    public function store(Request $request)
    {
        $type = 'SA_IV';

        try {
            // these are the name attributes in the form
            $validated = $request->validate([
                'name_of_the_student'=>'required|string|max:255',
                'roll_no' =>'required|string|max:255',
                'name_of_the_guide'=>'required|string|max:255',
                'title_of_the_project'=>'required|string|max:255',
                'submitted_or_sanctioned'=>'required|string|max:255',
                'sponsoring_agency'=>'required|string|max:255',
                'amount_sanctioned'=>'required|string|max:255',
                'dept'=>'required|string|max:255',
                'document_link'=>'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
            // dd($validated);

             // to store the file in public 
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('SA_Documents/SA_IV', $filename, 'public');
            }

            try{
                SA_IV::create([
                    'Name_of_student(s)'=>$validated['name_of_the_student'],
                    'user_id'=>$validated['user_id'],
                    'Roll_No'=>$validated['roll_no'],
                    'Name_of_the_Guide'=>$validated['name_of_the_guide'],
                    'Title_of_Project'=>$validated['title_of_the_project'],
                    'Submitted/Sanctioned'=>$validated['submitted_or_sanctioned'],
                    'Sponsoring_Agency_(Date of Submission/Sanctioned'=>$validated['sponsoring_agency'],
                    'Amount_Sanctioned_in_(Rs)'=>$validated['amount_sanctioned'],
                    'Dept'=>$validated['dept'],
                    'Document_Link'=>$validated['document_link'],
                     'Document'=>$validated['document']

                ]);

                return redirect( route('SA.view', ['type' => $type]))->with('success', 'Student activity created successfully.');
            }
             catch (\Exception $e) {
                   dd($e->getMessage());
                }
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create student activity: ' . $e->getMessage()]);
            dd($e->getMessage());
        }
    }

    //--------------------------update method------------------------------------------------------------------

    public function update(Request $request, $id)
    {
        try{
            $record=SA_IV::findOrFail($id);
            // validate input 
            $request->validate([

                'name_of_the_student'=>'required|string|max:255',
                'roll_no' =>'required|string|max:255',
                'name_of_the_guide'=>'required|string|max:255',
                'title_of_the_project'=>'required|string|max:255',
                'submitted_or_sanctioned'=>'required|string|max:255',
                'sponsoring_agency'=>'required|string|max:255',
                'amount_sanctioned'=>'required|string|max:255',
                'dept'=>'required|string|max:255',
                'document_link'=>'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'

            ]);

            // update details 

            $record['Name_of_student(s)']=$request->input('name_of_the_student');
            $record['Roll_No']=$request->input('roll_no');
            $record['Name_of_the_Guide']=$request->input('name_of_the_guide');
            $record['Title_of_Project']=$request->input('title_of_the_project');
            $record['Submitted/Sanctioned']=$request->input('submitted_or_sanctioned');
            $record['Sponsoring_Agency_(Date of Submission/Sanctioned']=$request->input('sponsoring_agency');
            $record['Amount_Sanctioned_in_(Rs)']=request->input('amount_sanctioned');
            $record['Dept']=$request->input('dept');
            $record['Document_Link']=$request->input('document_link');

            // Handle file upload only if new file is uploaded
            if ($request->hasFile('document')) {
                // Delete old file if exists
                if ($record->Document && Storage::disk('public')->exists($record->Document)) {
                    Storage::disk('public')->delete($record->Document);
                }

                // Store new file
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName();
                $record->Document = $file->storeAs('SA_Documents/SA_IV', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }

            $record->save();

            return redirect()
                ->route('SA.view', ['type' => 'SA_IV'])
                ->with('success', 'Student activity updated successfully.');
            
        }

        catch (\Exception $e) {
            dd($e->getMessage());
            
        }

    }

}
