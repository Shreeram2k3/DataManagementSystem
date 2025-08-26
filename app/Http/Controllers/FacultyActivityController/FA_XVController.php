<?php

namespace App\Http\Controllers\FacultyActivityController;
use App\Models\FacultyActivityModels\FA_XV;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FA_XVController extends Controller
{
    public function store(Request $request)
    {
        $type='FA_XV';
        try{
            $validate=$request->validate([
                'period_(from)'=>'required|date',
                'period_(to)'=>'required|date',
                'name_of_the_company' => 'required|string|max:255',
                'address_of_the_company' => 'required|string|max:255',
                'work_description' => 'required|string|max:255',
                'faculty_faculty_team' => 'required|string|max:255',
                'Amount' =>'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);

            $validated['user_id'] = auth()->id();
              if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_XV', $filename, 'public');
            }
            try{

            // left side column name in table, right side name attribute in form 
            FA_XV::create([
                'Period_(From)' => $validated['period_(from)'],
                'Period_(To)' => $validated['period_(to)'],
                'Name_of_the_Company' => $validated['name_of_the_company'],
                'Work_Description' => $validated['work_description'],
                'Faculty/Faculty_Team' => $validated['faculty_faculty_team'],
                'Amount_Generated(in_Rs)'  => $validated ['Amount'],
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
            $record = FA_XV::findOrFail($id);

            // Validate input
            $request->validate([
                 'period_(from)'=>'required|date',
                'period_(to)'=>'required|date',
                'name_of_the_company' => 'required|string|max:255',
                'address_of_the_company' => 'required|string|max:255',
                'work_description' => 'required|string|max:255',
                'faculty_faculty_team' => 'required|string|max:255',
                'Amount' =>'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record['Period_(From)'] = $request->input('period_(from)');
            $record['Period_(To)'] = $request->input('period_(to)');
            $record->Name_of_the_Company= $request->input('name_of_the_company');
            $record->Address_of_the_Company = $request->input('address_of_the_company');
            $record['Work_Description'] = $request->input('work_description');
            $record['Faculty/Faculty_Team']= $request->input('faculty_faculty_team');
            $record['Amount_Generated(in_Rs)']= $request->input('Amount');
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
        $record->Document = $file->storeAs('FA_Documents/FA_XV', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_XV'])->with('success', 'Faculty activity updated successfull');
    }
}
