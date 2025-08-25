<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Models\FacultyActivityModels\FA_VII;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FA_VIController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'FA_VII';
        try {
            $validated = $request->validate([
            
                'winter_summerschool' => 'required|string|max:255',
                'sponsoring_agency' => 'required|string|max:255',
                'title_of_the_programme' => 'required|string|max:255',
                'coordinator'=>'required|string|max:255',
                'period'=>'required|string|max:255',
                'amount'=>'required|string|max:255',
                'dept'=>'required|string|max:255',
                'outcome_ifsanctioned'=>'nullable|string|max:255',
                
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_VI', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            FA_VII::create([
                'Winter/SummerSchool' => $validated['winter_summerschool'],
                'Sponsoring_Agency' => $validated['sponsoring_agency'],
                'Title_of_the_Programme' => $validated['title_of_the_programme'],
                'Coordinator'=>$validated['coordinator'],
                'Period' => $validated['period'],
                'Amount(Rs)'=>$validated['amount'],
                'Dept'=>$validated['dept'],
                'Outcome(IfSanctioned)'=>$validated['outcome_ifsanctioned'],
                
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
            $record = FA_VII::findOrFail($id);

            // Validate input
            $request->validate([
                'winter_summerschool' => 'required|string|max:255',
                'sponsoring_agency' => 'required|string|max:255',
                'title_of_the_programme' => 'required|string|max:255',
                'coordinator'=>'required|string|max:255',
                'period'=>'required|string|max:255',
                'amount'=>'required|string|max:255',
                'dept'=>'required|string|max:255',
                'outcome_ifsanctioned'=>'nullable|string|max:255',
                
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record['Winter/SummerSchool'] = $request->input('winter_summerschool');
            $record['Sponsoring_Agency'] = $request->input('sponsoring_agency');
            $record->Title_of_the_Programme = $request->input('title_of_the_programme');
            $record['Coordinator'] = $request->input('coordinator');
            $record->Period = $request->input('period');
            $record['Amount(Rs)'] = $request->input('amount'); 
            $record['Dept'] = $request->input('dept');  
            $record['Outcome(IfSanctioned)'] = $request->input('outcome_ifsanctioned');
            $record->document_link = $request->input('document_link');
            

            // If a new document is uploaded
    if ($request->hasFile('document')) {
        // Delete old file if exists
        if ($record->Document && Storage::disk('public')->exists($record->Document)) {
            Storage::disk('public')->delete($record->Document);
        }

        // Save new file
        $file = $request->file('document');
        $filename = time() . '_' . $file->getClientOriginalName();
        $record->Document = $file->storeAs('FA_Documents/FA_VII', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_VII'])->with('success', 'Faculty activity updated successfull');
    }

    
}
