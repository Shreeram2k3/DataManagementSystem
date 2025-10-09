<?php

namespace App\Http\Controllers\DepartmentActivityController;

use App\Models\DepartmentActivityModels\DA_III; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DA_IIIController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'DA_III';
        try {
            $validated = $request->validate([
            
                'total_number_of_titles' => 'required|string|max:255',
                'total_number_of_books' => 'required|string|max:255',
                'total_number_of_reference_books' => 'required|string|max:255',
                'total_number_of_journals_subscribed_national' => 'required|string|max:255',
                'total_number_of_journals_subscribed_international' => 'required|string|max:255',
                'total_value_of_books/journals_investment(National)'=> 'required|string|max:255',
                'total_value_of_books/journals_investment(international)'=> 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
            $validated['document'] = $file->storeAs('DA_Documents/DA_III', $filename, 'public');
        }

        // dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            DA_III::create([
                'Total_Number_of_Titles' => $validated['total_number_of_titles'],

                'Total_Number_of_Books' => $validated['total_number_of_books'],

                'Total_Number_of_Reference_Books' => $validated['total_number_of_reference_books'],

                'Total_Number_of_Journals_Subscribed_National' => $validated['total_number_of_journals_subscribed_national'],

                'Total_Number_of_Journals_Subscribed_International' => $validated['total_number_of_journals_subscribed_international'],

                
                'Total_Value_of_Books/Journals_Investment(National)' => $validated['total_value_of_books/journals_investment(National)'],

                'Total_Value_of_Books/Journals_Investment(international)' => $validated['total_value_of_books/journals_investment(international)'],

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
            $record = DA_III::findOrFail($id);

            // Validate input
            $request->validate([
                'total_number_of_titles' => 'required|string|max:255',
                'total_number_of_books' => 'required|string|max:255',
                'total_number_of_reference_books' => 'required|string|max:255',
                'total_number_of_journals_subscribed_national' => 'required|string|max:255',
                'total_number_of_journals_subscribed_international' => 'required|string|max:255',
                'total_value_of_books/journals_investment(National)'=> 'required|string|max:255',
                'total_value_of_books/journals_investment(international)'=> 'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf|max:5120'
            ]);

            // Update fields
            $record->Total_Number_of_Titles = $request->input('total_number_of_titles');

            $record->Total_Number_of_Books = $request->input('total_number_of_books');

            $record->Total_Number_of_Reference_Books = $request->input('total_number_of_reference_books');

            $record->Total_Number_of_Journals_Subscribed_National = $request->input('total_number_of_journals_subscribed_national');

            $record->Total_Number_of_Journals_Subscribed_International = $request->input('total_number_of_journals_subscribed_international');

            $record['Total_Value_of_Books/Journals_Investment(National)'] = $request->input('total_value_of_books/journals_investment(National)');

            $record['Total_Value_of_Books/Journals_Investment(international)'] = $request->input('total_value_of_books/journals_investment(international)');

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
        $record->Document = $file->storeAs('DA_Documents/DA_III', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('DA.view', ['type' => 'DA_III'])->with('success', 'Department activity updated successfully');
    }

    
}
