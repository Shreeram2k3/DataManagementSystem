<?php

namespace App\Http\Controllers\DepartmentActivityController;

use App\Models\DepartmentActivityModels\DA_I; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DA_IController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'DA_I';
        try {
            $validated = $request->validate([
            
                'details_of_equipment'=>'required|string|max:255', 
                'number_of_equipment'=>'required|string|',              
                 'name_of_laboratory'=>'required|string|max:255',
                 'value_of_the_equipment_Rs'=>'required|string|max:255',
                 'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('DA_Documents/DA_I', $filename, 'public');
            }

        // dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            DA_I::create([
                'Details_of_Equipment' => $validated['details_of_equipment'],
                'Number_of_Equipment' => $validated['number_of_equipment'],
                'Name_of_Laboratory' => $validated['name_of_laboratory'],
                'Value_of_the_Equipment_Rs' => $validated['value_of_the_equipment_Rs'],
                'Dept'=> $validated['dept'],
                'Document_Link' => $validated['document_link'],
                'Document'=>$validated['document'],
                
                
                'user_id' => $validated['user_id']
            ]);
           return back()->with('success', 'Department activity added successfully.');

           
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
            $record = DA_I::findOrFail($id);

            // Validate input
            $request->validate([
                'details_of_equipment'=>'required|string|max:255', 
                'number_of_equipment'=>'required|string|',              
                 'name_of_laboratory'=>'required|string|max:255',
                 'value_of_the_equipment_Rs'=>'required|string|max:255',
                 'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf|max:5120'
            ]);

            // Update fields
            $record->Details_of_Equipment = $request->input('details_of_equipment');
            $record->Number_of_Equipment = $request->input('number_of_equipment');
            $record->Name_of_Laboratory = $request->input('name_of_laboratory');
            $record->Value_of_the_Equipment_Rs = $request->input('value_of_the_equipment_Rs');
            $record->Dept = $request->input('dept');

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
        $record->Document = $file->storeAs('DA_Documents/DA_I', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('DA.view', ['type' => 'DA_I'])->with('success', 'Department activity updated successfully');
    }

    
}
