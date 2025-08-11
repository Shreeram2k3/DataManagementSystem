<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_VIII;


class SA_VIIIController extends Controller
{
    public function store(Request $request)
    {
        $type= 'SA_VIII';
        // return "hi";

        try{
            // these are the name attributes in the form 
            $validated = $request->validate([

                'name_of_students'=>'required|string',
                'roll_no'=>'required|string',
                'name_of_the_organization'=>'required|string',
                'location'=>'required|string',
                'salary'=>'required|string',
                'date_of_interview'=>'required|date',
                'remarks'=>'required|string',
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
                $validated['document'] = $file->storeAs('SA_Documents/SA_VIII', $filename, 'public');
            }

            try{
                SA_VIII::create([
                    'Name_of_Student(s)'=>$validated['name_of_students'],                    
                    'Roll_No'=>$validated['roll_no'],
                    'Name_of_the_Organization'=>$validated['name_of_the_organization'],
                    'Location'=>$validated['location'],
                    'Name_of_the_Journal'=>$validated['name_of_the_journal'],
                    'Salary(Rs/Annum)'=>$validated['salary'],
                    'Date_of_Interview'=>$validated['date_of_interview'],
                    'Remarks'=>$validated['remarks'],
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
                $record=SA_VIII::findOrFail($id);
                // validate input 
                $request->validate([
                    
                'name_of_students'=>'required|string',
                'roll_no'=>'required|string',
                'name_of_the_organization'=>'required|string',
                'location'=>'required|string',
                'salary'=>'required|string',
                'date_of_interview'=>'required|date',
                'remarks'=>'required|string',
                'document_link'=>'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'

                ]);

                // update details 
                $record['Name_of_Student(s)']=$request->input('name_of_students');
                $record['Roll_No']=$request->input('roll_no');
                $record['Name_of_the_Organization']=$request->input('name_of_the_organization');
                $record['Location']=$request->input('location');
                $record['Salary(Rs/Annum)']=$request->input('salary');
                $record['Date_of_Interview']=$request->input('date_of_interview');
                $record['Remarks']=$request->input('remarks');
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
                $record->Document = $file->storeAs('SA_Documents/SA_VIII', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }

            $record->save();

            return redirect()
                ->route('SA.view', ['type' => 'SA_VIII'])
                ->with('success', 'Student activity updated successfully.');

            }
            catch (\Exception $e) {
                dd($e->getMessage());
                
            }
        }


}
