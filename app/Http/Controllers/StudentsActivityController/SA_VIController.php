<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentsActivityModels\SA_VI;


class SA_VIController extends Controller
{
    public function store(Request $request)
    {
        $type= 'SA_VI';
        // return "hi";

        try{
            // these are the name attributes in the form 
            $validated = $request->validate([

                'name_of_student'=>'required|string',
                'roll_no'=>'required|string',
                'date'=>'required|date',
                'event'=>'required|string',
                'place'=>'required|string',
                'participation_prize'=>'required|string',
                'remark'=>'required|string',
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
                $validated['document'] = $file->storeAs('SA_Documents/SA_II', $filename, 'public');
            }

            try{
                SA_VI::create([
                    'Name_of_Student(s)'=>$validated['name_of_student'],
                    'Roll_No'=>$validated['roll_no'],                    
                    'Date'=>$validated['date'],
                    'Event'=>$validated['event'],
                    'Place'=>$validated['place'],
                    'Participation/Prize'=>$validated['participation_prize'],
                    'Remark'=>$validated['remark'],
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
