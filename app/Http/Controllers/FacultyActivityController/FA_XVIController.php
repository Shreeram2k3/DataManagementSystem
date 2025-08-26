<?php

namespace App\Http\Controllers\FacultyActivityController;
use App\Models\FacultyActivityModels\FA_XVI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FA_XVIController extends Controller
{
    public function store(Request $request)
    {
        $type='FA_XVI';
        try{
            $validate=$request->validate([
                'name_of_the_company'=>'required|string|max:255',
                'address' => 'required|string|max:255',
                'benefits_opportunities_utilized' => 'required|string|max:255',
                'MoU_duration' => 'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);

            $validated['user_id'] = auth()->id();
              if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_XVI', $filename, 'public');
            }
            try{

            // left side column name in table, right side name attribute in form 
            FA_XVI::create([
                'Name_of_the_Company' => $validated['name_of_the_company'],
                'Address' => $validated['address'],
                'Benefits/Opportunities_Utilized' => $validated['benefits_opportunities_utilized'],
                'MoU_Duration' => $validated['MoU_duration'],
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
            $record = FA_XVI::findOrFail($id);

            // Validate input
            $request->validate([
                 'name_of_the_company'=>'required|string|max:255',
                'address' => 'required|string|max:255',
                'benefits/opportunities_utilized' => 'required|string|max:255',
                'MoU_duration' => 'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Name_of_the_Company = $request->input('name_of_the_faculty_member');
            $record->Address = $request->input('title_of_the_project');
            $record['Benefits/Opportunities_Utilized']= $request->input('funding_agency');
            $record->MoU_Duration = $request->input('duration');
            $record['Amount_(Rs_In_Lakhs'] = $request->input('amount');
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
        $record->Document = $file->storeAs('FA_Documents/FA_XVI', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_XVI'])->with('success', 'Faculty activity updated successfull');
    }
}
