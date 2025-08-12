<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_VII;


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
                    'Conference_Details'=>$validated['Conference_Details'],
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
}
