<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_V;

class SA_VController extends Controller
{
    public function store(Request $request)
    {
        $type= 'SA_V';
        // return "hi";

        try{
            //  these are the name attributes in the form
            $validated = $request->validate([
                'name_of_student'=>'required|string',
                'roll_no'=>'required|string',
                'title_of_the_model'=>'required|string',
                'organizer_details'=>'required|string',
                'date'=>'required|date',
                'status'=>'required|string',
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
                $validated['document'] = $file->storeAs('SA_Documents/SA_V', $filename, 'public');
            }

            try{
                SA_V::create([
                    'Name_of_Student(s)'=>$validated['name_of_student'],
                    'Roll_No'=>$validated['roll_no'],
                    'Title_of_the_Model/Product_Developed'=>$validated['title_of_the_model'],
                    'Organizer_Details(Venue)'=>$validated['organizer_details'],
                    'Date'=>$validated['date'],
                    'Status(Further_enchancement/Final_stage)'=>$validated['status'],
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

    // -------------------------------------------------------------update method------------------------------------------------------------------------------

        public function update(Request $request,$id)
    {
        try{
            $record=SA_V::findOrFail($id);

            // validate input 
            $request->validate([

                'name_of_student'=>'required|string',
                'roll_no'=>'required|string',
                'title_of_the_model'=>'required|string',
                'organizer_details'=>'required|string',
                'date'=>'required|date',
                'status'=>'required|string',
                'document_link'=>'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'    

            ]);

            // update  details 

            $record['Name_of_Student(s)']=$request->input('name_of_student');
            $record['Roll_No']=$request->input('roll_no');
            $record['Title_of_the_Model/Product_Developed']=$request->input('title_of_the_model');
            $record['Organizer_Details(Venue)']=$request->input('organizer_details');
            $record['Date']=$request->input('date');
            $record['Status(Further_enchancement/Final_stage)']=$request->input('status');
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
                $record->Document = $file->storeAs('SA_Documents/SA_V', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }

            $record->save();

            return redirect()
                ->route('SA.view', ['type' => 'SA_V'])
                ->with('success', 'Student activity updated successfully.'); 

        }

         catch (\Exception $e) {
            dd($e->getMessage());
            
        }
    }
}

