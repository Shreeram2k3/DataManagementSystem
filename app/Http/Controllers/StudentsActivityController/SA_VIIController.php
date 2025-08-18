<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_VII;
use Illuminate\Support\Facades\Storage;


class SA_VIIController extends Controller
{
    public function store(Request $request)
    {
        $type= 'SA_VII';
        // return "hi";

        try{
            // these are the name attributes in the form 
            $validated = $request->validate([

                'month'=>'required|string',
                'name_of_students'=>'required|string',
                'roll_no'=>'required|string',
                'staff_ifguided'=>'required|string',
                'title_of_the_paper'=>'required|string',
                'name_of_the_journal'=>'required|string',
                'volumne_no'=>'required|string',
                'page_no'=>'required|string',
                'conference_details' => 'required|string',
                'national_international'=>'required|string',
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
                $validated['document'] = $file->storeAs('SA_Documents/SA_VII', $filename, 'public');
            }

            try{
                SA_VII::create([
                   'Month' =>$validated['month'],
                    'Name_of_Student(s)'=>$validated['name_of_students'],                    
                    'Roll_No'=>$validated['roll_no'],
                    'Staff(if_guided)'=>$validated['staff_ifguided'],
                    'Title_of_the_Paper'=>$validated['title_of_the_paper'],
                    'Name_of_the_Journal'=>$validated['name_of_the_journal'],
                    'Volume_No'=>$validated['volumne_no'],
                    'Page_Nos'=>$validated['page_no'],
                    'Conference_Details'=>$validated['conference_details'],
                    'National/International'=>$validated['national_international'],
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
                $record=SA_VII::findOrFail($id);
                // validate input 
                $request->validate([
                    
                'month'=>'required|string',
                'name_of_students'=>'required|string',
                'roll_no'=>'required|string',
                'staff_ifguided'=>'required|string',
                'title_of_the_paper'=>'required|string',
                'name_of_the_journal'=>'required|string',
                'volumne_no'=>'required|string',
                'page_no'=>'required|string',
                'conference_details' => 'required|string',
                'national_international'=>'required|string',
                'dept'=>'required|string',
                'document_link'=>'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'

                ]);

                // update details 
                $record['Month']=$request->input('month');
                $record['Name_of_Student(s)']=$request->input('name_of_students');
                $record['Roll_No']=$request->input('roll_no');
                $record['Staff(if_guided)']=$request->input('staff_ifguided');
                $record['Title_of_the_Paper']=$request->input('title_of_the_paper');
                $record['Name_of_the_Journal']=$request->input('name_of_the_journal');
                $record['Volume_No']=$request->input('volumne_no');
                $record['Page_Nos']=$request->input('page_no');
                $record['Conference_Details']=$request->input('conference_details');
                $record['National/International']=$request->input('national_international');
                $record['Dept']=$request->input('dept');
                $record['Document_Link']=$request->input('document_link');


                if ($request->hasFile('document')) {
                // Delete old file if exists
                if ($record->Document && Storage::disk('public')->exists($record->Document)) {
                    Storage::disk('public')->delete($record->Document);
                }

                // Store new file
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName();
                $record->Document = $file->storeAs('SA_Documents/SA_VII', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }

            $record->save();

            return redirect()
                ->route('SA.view', ['type' => 'SA_VII'])
                ->with('success', 'Student activity updated successfully.');

            }
            catch (\Exception $e) {
                dd($e->getMessage());
                
            }
        }

}
