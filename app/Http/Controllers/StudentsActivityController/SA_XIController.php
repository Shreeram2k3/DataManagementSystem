<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_XI;
use Illuminate\Support\Facades\Storage;



class SA_XIController extends Controller
{
    public function store(Request $request)
    {
        $type= 'SA_XI';
        // return "hi";

        try{
            // these are the name attributes in the form 
            $validated = $request->validate([

                'date'=>'required|date',
                'semester'=>'required|string',
                'programme'=>'required|string',
                'resource_person'=>'required|string',
                'details'=>'required|string',
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
                $validated['document'] = $file->storeAs('SA_Documents/SA_XI', $filename, 'public');
            }

            try{
                SA_XI::create([
                    'Date'=>$validated['date'],
                    'Semester'=>$validated['semester'],                    
                    'Programme'=>$validated['programme'],
                    'Resource_Person'=>$validated['resource_person'],          
                    'Details'=>$validated['details'],
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
                $record=SA_XI::findOrFail($id);
                // validate input 
                $request->validate([
                    
                 'date'=>'required|date',
                'semester'=>'required|string',
                'programme'=>'required|string',
                'resource_person'=>'required|string',
                'details'=>'required|string',
                'coordinator'=>'required|string',
                'dept'=>'required|string',
                'document_link'=>'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'

                ]);

                // update details 
                $record['Date']=$request->input('date');
                $record['Semester']=$request->input('semester');
                $record['Programme']=$request->input('roll_no');
                $record['Resource_Person']=$request->input('resource_person');
                $record['Details']=$request->input('details');
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
                $record->Document = $file->storeAs('SA_Documents/SA_XI', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }

            $record->save();

            return redirect()
                ->route('SA.view', ['type' => 'SA_XI'])
                ->with('success', 'Student activity updated successfully.');

            }
            catch (\Exception $e) {
                dd($e->getMessage());
                
            }
        }

}
