<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_XV;
use Illuminate\Support\Facades\Storage;



class SA_XIVController extends Controller
{
    public function store(Request $request)
    {
        $type= 'SA_XV';
        // return "hi";

        try{
            // these are the name attributes in the form 
            $validated = $request->validate([

                'semester'=>'required|string',
                'date'=>'required|date',
                'number_of_parents'=>'required|string',
                'remarks'=>'required|string',
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
                $validated['document'] = $file->storeAs('SA_Documents/SA_XV', $filename, 'public');
            }

            try{
                SA_XI::create([
                    'Semester'=>$validated['semester'],
                    'Date'=>$validated['date'],                    
                    'Number_of_Parents'=>$validated['number_of_parents'],
                    'Remarks'=>$validated['remarks'],          
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
                $record=SA_XV::findOrFail($id);
                // validate input 
                $request->validate([
                    
                'semester'=>'required|string',
                'date'=>'required|date',
                'number_of_parents'=>'required|string',
                'remarks'=>'required|string',
                'dept'=>'required|string',
                'document_link'=>'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'


                ]);

                // update details 
                $record['Semester']=$request->input('semester');
                $record['Date']=$request->input('date');
                $record['Number_of_Parents']=$request->input('number_of_parents');
                $record['Remarks']=$request->input('remarks');
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
                $record->Document = $file->storeAs('SA_Documents/SA_XV', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }

            $record->save();

            return redirect()
                ->route('SA.view', ['type' => 'SA_XV'])
                ->with('success', 'Student activity updated successfully.');

            }
            catch (\Exception $e) {
                dd($e->getMessage());
                
            }
        }

}
