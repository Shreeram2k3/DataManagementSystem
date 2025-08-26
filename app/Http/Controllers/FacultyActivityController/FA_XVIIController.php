<?php

namespace App\Http\Controllers\FacultyActivityController;
use App\Models\FacultyActivityModels\FA_XVII;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FA_XVIController extends Controller
{
    public function store(Request $request)
    {
        $type='FA_XVII';
        try{
            $validate=$request->validate([
                'faculty_name'=>'required|string|max:255',
                'industry_visited' => 'required|string|max:255',
                'period_date' => 'required|string|max:255',
                'outcome' => 'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);

            $validated['user_id'] = auth()->id();
              if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_XVII', $filename, 'public');
            }
            try{

            // left side column name in table, right side name attribute in form 
            FA_XVII::create([
                'Faculty_name' => $validated['faculty_namey'],
                'Industry_visited' => $validated['industry_visited'],
                'Period/Date' => $validated['period_date'],
                'Outcome' => $validated['outcome'],
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
            $record = FA_XVII::findOrFail($id);

            // Validate input
            $request->validate([
                 'faculty_name'=>'required|string|max:255',
                'industry_visited' => 'required|string|max:255',
                'period_date' => 'required|string|max:255',
                'outcome' => 'required|string|max:255',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Faculty_name = $request->input('faculty_name');
            $record->Industry_visited = $request->input('industry_visited');
            $record['Period/Date']= $request->input('period_date');
            $record->Outcome = $request->input('outcome');
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
        $record->Document = $file->storeAs('FA_Documents/FA_XVII', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_XVII'])->with('success', 'Faculty activity updated successfull');
    }
}
