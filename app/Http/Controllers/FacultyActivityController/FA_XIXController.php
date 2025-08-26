<?php

namespace App\Http\Controllers\FacultyActivityController;
use App\Models\FacultyActivityModels\FA_XIX;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FA_XVIController extends Controller
{
    public function store(Request $request)
    {
        $type='FA_XIX';
        try{
            $validate=$request->validate([
                'name_of_the_staff'=>'required|string|max:255',
                'faculty' => 'required|string|max:255',
                'university' => 'required|string|max:255',
                'date_of_recognition' => 'required|date',
                'reference_no' => 'required|string|max:255',
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
            FA_XIX::create([
                'Name_of_the_Staff' => $validated['name_of_the_staff'],
                'Faculty' => $validated['faculty'],
                'University' => $validated['university'],
                'Date_of_Recognition' => $validated['date_of_recognition'],
                'Reference_No' => $validate['reference_no'],
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
            $record = FA_XIX::findOrFail($id);

            // Validate input
            $request->validate([
                 'name_of_the_staff'=>'required|string|max:255',
                'faculty' => 'required|string|max:255',
                'university' => 'required|string|max:255',
                'date_of_recognition' => 'required|date',
                'reference_no' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Name_of_the_Staff = $request->input('name_of_the_staff');
            $record->Faculty= $request->input('faculty');
            $record->University= $request->input('university');
            $record->Date_of_Recognition = $request->input('date_of_recognition');
            $record->Reference_No= $request->input('reference_no');
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
