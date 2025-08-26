<?php

namespace App\Http\Controllers\FacultyActivityController;
use App\Models\FacultyActivityModels\FA_XIII;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FA_XIIIController extends Controller
{
    public function store(Request $request)
    {
        $type='SA_XIII';
        try{
            $validate=$request->validate([
                'name_of_the_faculty_member' => 'required|string|max:255',
                'part_time_full_time' => 'required|string|max:255',
                'internal_external' => 'required|string|max:255',
                'name_of_the_scholar' => 'required|string|max:255',
                'address_of_external' => 'required|string|max:255',
                'date_of_registration' =>'required|date',
                'research_area' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);

            $validated['user_id'] = auth()->id();
              if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_XIII', $filename, 'public');
            }
            try{

            // left side column name in table, right side name attribute in form 
            FA_XIII::create([
                'Name_of_the_Faculty_Member' => $validated['name_of_the_faculty_member'],
                'Part_time/Full_Time' => $validated['part_time_full_time'],
                'Internal/External' => $validated['internal_external'],
                'Name_of_the_Scholar' => $validated['name_of_the_scholar'],
                'Address_of_external' => $validated['address_of_external'],
                'Date_of_Registration' => $validated['date_of_registration'],
                'Research_Area' => $validated['research_area'],
                'Status' => $validated['status'],
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
            $record = FA_XIII::findOrFail($id);

            // Validate input
            $request->validate([
                'name_of_the_faculty_member' => 'required|string|max:255',
                'part_time_full_time' => 'required|string|max:255',
                'internal_external' => 'required|string|max:255',
                'name_of_the_scholar' => 'required|string|max:255',
                'address_of_external' => 'required|string|max:255',
                'date_of_registration' =>'required|date',
                'research_area' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Name_of_the_Faculty_Member = $request->input('name_of_the_faculty_member');
            $record['Part_time/Full_Time'] = $request->input('part_time_full_time');
            $record['Internal/External'] = $request->input('internal_external');
            $record->Name_of_the_Scholar= $request->input('name_of_the_scholar');
            $record->Address_of_external = $request->input('address_of_external');
            $record->Date_of_Registration = $request->input('Date_of_Registrationt');
            $record->Research_Area= $request->input('research_areas');
            $record->Status= $request->input('status');
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
        $record->Document = $file->storeAs('FA_Documents/FA_XIII', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_XIII'])->with('success', 'Faculty activity updated successfull');
    }
}
