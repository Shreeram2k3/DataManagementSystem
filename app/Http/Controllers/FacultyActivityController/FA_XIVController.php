<?php

namespace App\Http\Controllers\FacultyActivityController;
use App\Models\FacultyActivityModels\FA_XIV;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FA_XIVController extends Controller
{
    public function store(Request $request)
    {
        $type='FA_XIV';
        try{
            $validate=$request->validate([
                'name_of_the_faculty_member'=>'required|string|max:255',
                'title_of_the_project' => 'required|string|max:255',
                'funding_agency' => 'required|string|max:255',
                'duration' => 'required|string|max:255',
                'amount' => 'required|string|max:255',
                'date' =>'required|date',
                'sanctioned_submitted' => 'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);

            $validated['user_id'] = auth()->id();
              if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_XIV', $filename, 'public');
            }
            try{

            // left side column name in table, right side name attribute in form 
            FA_XIV::create([
                'Name_of_the_Faculty_Member' => $validated['name_of_the_faculty_member'],
                'Title_of_the_Project' => $validated['title_of_the_project'],
                'Funding_Agency' => $validated['funding_agency'],
                'Duration' => $validated['duration'],
                'Amount_(Rs_In_Lakhs)' => $validated['amount'],
                'Date_of_submission_or_sanction'  => $validated ['date'],
                'Sanctioned/Submitted'  => $validated ['sanctioned_submitted'],
                'Dept' => $validate['dept'],
                'Document_Link' => $validated['document_link'],
                'Document'=>$validated['document'],
                
                
                'user_id' => $validated['user_id']
            ]);
           return back()->with('success', 'Faculty  activity added successfully.');

           
           }
              catch (\Exception $e) {
                   dd($e->getMessage());
                }

        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create student activity: ' . $e->getMessage()]);
        }
    }

    //---------------- ----------------------------------

    public function update(Request $request, $id)
    {
            $record = FA_XIV::findOrFail($id);

            // Validate input
            $request->validate([
                 'name_of_the_faculty_member'=>'required|string|max:255',
                'title_of_the_project' => 'required|string|max:255',
                'funding_agency' => 'required|string|max:255',
                'duration' => 'required|string|max:255',
                'amount' => 'required|string|max:255',
                'date' =>'required|date',
                'sanctioned_submitted' => 'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Name_of_the_Faculty_Member = $request->input('name_of_the_faculty_member');
            $record->Title_of_the_Project = $request->input('title_of_the_project');
            $record->Funding_Agency= $request->input('funding_agency');
            $record->Duration = $request->input('duration');
            $record['Amount_(Rs_In_Lakhs'] = $request->input('amount');
            $record->Date_of_submission_or_sanction= $request->input('date');
            $record['Sanctioned/Submitted']= $request->input('sanctioned_submitted');
            $record->Dept= $request->input('dept');
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
        $record->Document = $file->storeAs('FA_Documents/FA_XIV', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_XIV'])->with('success', 'Faculty activity updated successfull');
    }
}
