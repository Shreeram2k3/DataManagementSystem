<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Models\FacultyActivityModels\FA_VIII;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FA_VIIIController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'FA_VIII';
        try {
            $validated = $request->validate([
            
                'name_of_the_programme' => 'required|string|max:255',
                'name_of_the_coordinators' => 'required|string|max:255',
                'total_no_of_participants_tn' => 'required|string|max:255',
                'total_no_of_participants_others'=>'required|string|max:255',
                'total_no_of_participants_bit'=>'required|string|max:255',
                'from_date' => 'required|date',
                'to_date' => 'required|date',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_VIII', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            FA_VIII::create([
                'Name_of_winter/SummerSchool/FDPTitle_of_the_programme' => $validated['name_of_the_programme'],
                'Name_of_the_coordinator(s)' => $validated['name_of_the_coordinators'],
                'Total_No_of_Participants(TN)' => $validated['total_no_of_participants_tn'],
                'Total_No_of_Participants(Others)'=>$validated['total_no_of_participants_others'],
                'Total_No_of_Participants(BIT)' => $validated['total_no_of_participants_bit'],
                'From_date'=>$validated['from_date'],
                'To_date'=>$validated['to_date'],
                'Dept'=>$validated['dept'],
                
                'Document_Link' => $validated['document_link'],
                'Document'=>$validated['document'],
                
                
                'user_id' => $validated['user_id']
            ]);
           return back()->with('success', 'Faculty activity added successfully.');

           
           }
              catch (\Exception $e) {
                   dd($e->getMessage());
                }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to add Faculty activity: ' . $e->getMessage()]);
        }
    }
    public function update(Request $request, $id)
    {
            $record = FA_VIII::findOrFail($id);

            // Validate input
            $request->validate([
                'name_of_the_programme' => 'required|string|max:255',
                'name_of_the_coordinators' => 'required|string|max:255',
                'total_no_of_participants_tn' => 'required|string|max:255',
                'total_no_of_participants_others'=>'required|string|max:255',
                'total_no_of_participants_bit'=>'required|string|max:255',
                'from_date' => 'required|date',
                'to_date' => 'required|date',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record['Name_of_winter/SummerSchool/FDPTitle_of_the_programme'] = $request->input('name_of_the_programme');
            $record['Name_of_the_coordinator(s)'] = $request->input('name_of_the_coordinators');
            $record['Total_No_of_Participants(TN)'] = $request->input('total_no_of_participants_tn');
            $record['Total_No_of_Participants(Others)'] = $request->input('total_no_of_participants_others');
            $record['Total_No_of_Participants(BIT)'] = $request->input('total_no_of_participants_bit');
            $record['From_date'] = $request->input('from_date'); 
            $record['To_date'] = $request->input('to_date'); 
            $record['Dept'] = $request->input('dept');  
            $record->Document_Link = $request->input('document_link');
            

            // If a new document is uploaded
    if ($request->hasFile('document')) {
        // Delete old file if exists
        if ($record->Document && Storage::disk('public')->exists($record->Document)) {
            Storage::disk('public')->delete($record->Document);
        }

        // Save new file
        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $record->Document = $file->storeAs('FA_Documents/FA_VIII', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_VIII'])->with('success', 'Faculty activity updated successfull');
    }

    
}
