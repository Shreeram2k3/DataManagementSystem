<?php

namespace App\Http\Controllers\FacultyActivityController;
use App\Models\FacultyActivityModels\FA_XVIII;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FA_XVIController extends Controller
{
    public function store(Request $request)
    {
        $type='FA_XVIII';
        try{
            $validate=$request->validate([
                'name_of_the_faculty_member'=>'required|string|max:255',
                'award_name' => 'required|string|max:255',
                'applied_awarded' => 'required|string|max:255',
                'date' => 'required|date',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);

            $validated['user_id'] = auth()->id();
              if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_XVIII', $filename, 'public');
            }
            try{

            // left side column name in table, right side name attribute in form 
            FA_XVIII::create([
                'Name_of_the_Faculty_Member' => $validated['name_of_the_faculty_member'],
                'Award_Name' => $validated['award_name'],
                'Applied/Awarded' => $validated['applied_awarded'],
                'Date' => $validated['date'],
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
            $record = FA_XVIII::findOrFail($id);

            // Validate input
            $request->validate([
                 'name_of_the_faculty_member'=>'required|string|max:255',
                'award_name' => 'required|string|max:255',
                'applied_awarded' => 'required|string|max:255',
                'date' => 'required|date',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Name_of_the_Faculty_Member = $request->input('name_of_the_faculty_member');
            $record->Award_Name= $request->input('award_name');
            $record['Applied/Awarded']= $request->input('applied_awarded');
            $record->Date = $request->input('date');
            $record->Dept= $request->input('dept');
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
        $record->Document = $file->storeAs('FA_Documents/FA_XVIII', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_XVIII'])->with('success', 'Faculty activity updated successfull');
    }
}
