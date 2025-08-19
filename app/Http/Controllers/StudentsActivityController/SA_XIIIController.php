<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_XIII;
use Illuminate\Support\Facades\Storage;



class SA_XIIIController extends Controller
{
    public function store(Request $request)
    {
        $type= 'SA_XIII';
        // return "hi";

        try{
            // these are the name attributes in the form 
            $validated = $request->validate([

                'semester'=>'required|string',
                'from_date'=>'required|date',
                'to_date'=>'required|date',
                'factory_visited'=>'required|string',
                'name_student_staff'=>'required|string',
                'department'=>'required|string',
                'assessment_details'=>'required|string',
                'document_link'=>'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'


            ]);

            // set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
             //dd($validated);

             // to store the file in public 
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('SA_Documents/SA_XIII', $filename, 'public');
            }

            try{
                SA_XIII::create([
                    'Semester'=>$validated['semester'],                    
                    'From_Date'=>$validated['from_date'],
                    'To_Date'=>$validated['to_date'],
                    'Factory_Visited'=>$validated['factory_visited'],
                    'Name_of_the_staff/Students'=>$validated['name_student_staff'],          
                    'Department'=>$validated['department'],                
                    'Assessment_Details'=>$validated['assessment_details'],
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
                $record=SA_XIII::findOrFail($id);
                // validate input 
                $request->validate([
                    
                 'semester'=>'required|string',
                'from_date'=>'required|date',
                'to_date'=>'required|date',
                'factory_visited'=>'required|string',
                'name_student_staff'=>'required|string',
                'department'=>'required|string',
                'assessment_details'=>'required|string',
                'document_link'=>'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'


                ]);

                // update details 
                $record['Semester']=$request->input('semester');
                $record['From_Date']=$request->input('from_date');
                $record['To_Date']=$request->input('to_date');
                $record['Factory_Visited']=$request->input('factory_visited');
                $record['Name_of_the_staff/Students']=$request->input('name_student_staff');
                $record['Department']=$request->input('department');
                $record['Assessment_Details']=$request->input('assessment_details');
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
                $record->Document = $file->storeAs('SA_Documents/SA_XIII', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }

            $record->save();

            return redirect()
                ->route('SA.view', ['type' => 'SA_XIII'])
                ->with('success', 'Student activity updated successfully.');

            }
            catch (\Exception $e) {
                dd($e->getMessage());
                
            }
        }

}
