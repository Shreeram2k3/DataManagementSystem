<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_IX;


class SA_IXController extends Controller
{
    public function store(Request $request)
    {
        $type= 'SA_VIII';
        // return "hi";

        try{
            // these are the name attributes in the form 
            $validated = $request->validate([

                'semester'=>'required|string',
                'name_of_course'=>'required|string',
                'name_of_faculty_resource_person'=>'required|string',
                'from_date'=>'required|date',
                'to_date'=>'required|date',
                'value_added_one_credit'=>'required|string',
                'coordinator'=>'required|string',
                'dept'=>'required|string',
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
                $validated['document'] = $file->storeAs('SA_Documents/SA_IX', $filename, 'public');
            }

            try{
                SA_IX::create([
                    'Semester'=>$validated['semester'],                    
                    'Name_of_Course'=>$validated['name_of_course'],
                    'Name_of_Faculty/Resource_Person'=>$validated['name_of_faculty_resource_person'],
                    'From_Date'=>$validated['from_date'],
                    'To_Date'=>$validated['to_date'],
                    'Value_Added/One_Credit'=>$validated['value_added_one_credit'],
                    'Coordinator'=>$validated['coordinator'],
                    'Dept'=>$validated['dept'],
                    'Document_Link'=>$validated['document_link'],
                    'Document'=>$validated['document'],
                    'user_id'=>$validated['user_id']
                ]);
                return redirect( route('SA.view', ['type' => $type]))->with('success', 'Student activity Added successfully.');
                
            }
             catch (\Exception $e) {
                   dd($e->getMessage());
                }

        }
         catch (\Exception $e) {
            // return redirect()->back()->withErrors(['error' => 'Failed to create student activity: ' . $e->getMessage()]);
            dd($e->getMessage());
        }
    }

    //--------------------------update method------------------------------------------------------------------

        public function update(Request $request, $id)
        {
            try
            {
                $record=SA_IX::findOrFail($id);
                // validate input 
                $request->validate([
                    
                'semester'=>'required|string',
                'name_of_course'=>'required|string',
                'name_of_faculty_resource_person'=>'required|string',
                'from_date'=>'required|date',
                'to_date'=>'required|date',
                'value_added_one_credit'=>'required|string',
                'coordinator'=>'required|string',
                'dept'=>'required|string',
                'document_link'=>'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'

                ]);

                // update details 
                $record['Semester']=$request->input('semester');
                $record['Name_of_Course']=$request->input('name_of_course');
                $record['Name_of_Faculty/Resource_Person']=$request->input('name_of_faculty_resource_person');
                $record['From_Date']=$request->input('from_date');
                $record['To_Date']=$request->input('to_date');
                $record['Value_Added/One_Credit']=$request->input('value_added_one_credit');
                $record['Coordinator']=$request->input('coordinator');
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
                $record->Document = $file->storeAs('SA_Documents/SA_IX', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }

            $record->save();

            return redirect()
                ->route('SA.view', ['type' => 'SA_IX'])
                ->with('success', 'Student activity updated successfully.');

            }
            catch (\Exception $e) {
                dd($e->getMessage());
                
            }
        }

}
