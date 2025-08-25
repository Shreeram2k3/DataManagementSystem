<?php

namespace App\Http\Controllers\FacultyActivityController;

use App\Models\FacultyActivityModels\FA_I;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FA_IController extends Controller
{
   
    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'FA_I';
        try {
            $validated = $request->validate([
            
                'name_of_the_faculty' => 'required|string|max:255',
                'id' => 'required|string|max:255',
                'title_of_the_paper' => 'required|string|max:255',
                'name_of_the_journal_volume' => 'required|string|max:255',
                'page_nos_impact_factor_value' => 'required|string|max:255',
                'national_international' => 'required|string|max:255',
                'scopus_sci_others'=>'required|string|max:255',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('FA_Documents/FA_I', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            FA_I::create([
                'Name_of_the_Faculty' => $validated['name_of_the_faculty'],
                'ID' => $validated['id'],
                'Title_of_the_Paper' => $validated['title_of_the_paper'],
                'Name_of_the_Journal_Volume' => $validated['name_of_the_journal_volume'],
                'Page_Nos_Impact_Factor_value' => $validated['page_nos_impact_factor_value'],
                'National_International' => $validated['national_international'],
                'Scopus_SCI_others' => $validated['scopus_sci_others'],
                'Dept'=>$validated['dept'],
                'Document_Link' => $validated['document_link'],
                'Document'=>$validated['document'],
                
                
                'user_id' => $validated['user_id']
            ]);
           return back()->with('success', 'Faculty activity added successfully.');

           
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
            $record = FA_I::findOrFail($id);

            // Validate input
            $request->validate([
                'name_of_the_faculty' => 'required|string|max:255',
                'id' => 'required|string|max:255',
                'title_of_the_paper' => 'required|string|max:255',
                'name_of_the_journal_volume' => 'required|string|max:255',
                'page_nos_impact_factor_value' => 'required|string|max:255',
                'national_international' => 'required|string|max:255',
                'scopus_sci_others'=>'required|string|max:255',
                'dept'=>'required|string|max:255',
                'document_link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record->Name_of_the_Faculty = $request->input('name_of_the_faculty');
            $record->ID = $request->input('id');
            $record->Title_of_the_Paper = $request->input('title_of_the_paper');
            $record->Name_of_the_Journal_Volume = $request->input('name_of_the_journal_volume');
            $record->Page_Nos_Impact_Factor_value = $request->input('page_nos_impact_factor_value');
            $record['National/International'] = $request->input('national_international');
            $record['Scopus/SCI/others'] = $request->input('scopus_sci_others');
            $record['Dept'] = $request->input('dept');

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
        $record->Document = $file->storeAs('FA_Documents/FA_I', $filename, 'public');
    }
    // else → keep old file

            $record->save();

            return redirect()->route('FA.view', ['type' => 'FA_I'])->with('success', 'Faculty activity updated successfull');
    }

    
}
