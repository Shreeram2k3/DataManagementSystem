<?php

namespace App\Http\Controllers\DepartmentActivityController;

use App\Models\DepartmentActivityModels\DA_II; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DA_IIController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'DA_II';
        try {
            $validated = $request->validate([
            
                'name_of_the_faculty' => 'required|string|max:255',
                'name_of_the_equipment_failed' => 'required|string|max:255',
                'name_of_the_lab' => 'required|string|max:255',
                'servicing_details' => 'required|string|max:255',
                'amount_Rs' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'date' => 'required|date',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('DA_Documents/DA_II', $filename, 'public');
            }

        // dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            DA_II::create([
                'Name_of_the_Faculty' => $validated['name_of_the_faculty'],
                'Name_of_the_Equipment_failed/Serviced' => $validated['name_of_the_equipment_failed'],
                'Name_of_the_Lab' => $validated['name_of_the_lab'],
                'Servicing_details' => $validated['Servicing_details'],
                'Amount_Rs' => $validated['amount_Rs'],
                'status' => $validated['status'],
                'Date' => $validated['date'],
                'Dept' => $validated['dept'],
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
            $record = DA_II::findOrFail($id);

            // Validate input
            $request->validate([
                'name_of_the_faculty' => 'required|string|max:255',
                'name_of_the_equipment_failed' => 'required|string|max:255',
                'name_of_the_lab' => 'required|string|max:255',
                'servicing_details' => 'required|string|max:255',
                'amount_Rs' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'date' => 'required|date',
                'dept' => 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record['Name_of_the_Equipment_failed/Serviced'] = $request->input('name_of_the_equipment_failed');
            $record->Name_of_the_Lab = $request->input('name_of_the_lab');
            $record->Servicing_details = $request->input('servicing_details');
            $record->Amount_Rs = $request->input('amount_Rs');
            $record->status = $request->input('status');
            $record->Date = $request->input('date');
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
        $record->Document = $file->storeAs('DA_Documents/DA_II', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('DA.view', ['type' => 'DA_II'])->with('success', 'Department activity updated successfully');
    }

    
}
