<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Http\Controllers\Controller;
use App\Models\StudentsActivityModels\SA_II;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class SA_IIController extends Controller
{
    //

     public function store(Request $request)
    {
        
        try {
            $validated = $request->validate([

                'Name_of_student(s)' => 'required|string|max:255',
                'Roll_No' => 'required|string|max:50',
                'class' => 'required|string|max:50',
                'Title_of_Event/Presentation' => 'required|string|max:255',
                'Venue' => 'required|string|max:255',
                'Prize/place' => 'required|string|max:255',
                'Date' => 'required|date',
                'Document_Link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();

            // to store the file in public 
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('SA_Documents/SA_II', $filename, 'public');
            }

            //dd($validated);
            try{
                SA_II::create([
                    'Name_of_student(s)' => $validated['Name_of_student(s)'],
                    'Roll_No' => $validated['Roll_No'],
                    'class' => $validated['class'],
                    'Title_of_Event/Presentation' => $validated['Title_of_Event/Presentation'],
                    'Venue' => $validated['Venue'],
                    'Prize/place' => $validated['Prize/place'],
                    'Date' => $validated['Date'],
                    'Document_Link' => $validated['Document_Link'],
                    'Document'=>$validated['document'],
                    'user_id' => $validated['user_id']
                ]);
                return redirect(route('SA.view', ['type' => 'SA_II']))->with('success', 'Student activity created successfully.');
            } 
            catch (\Exception $e) {
                // Handle the exception
                dd($e->getMessage());
                return redirect()->route('dashboard')->with('error', 'Failed to store activity: '.$e->getMessage());
            }

           
          
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Failed to store activity: ');
        }
    }


   public function update(Request $request, $id)
    {    try{
            $record = SA_II::findOrFail($id);

            // Validate input
            $request->validate([
                'Name_of_student(s)' => 'required|string|max:255',
                'Roll_No' => 'required|string|max:50',
                'class' => 'required|string|max:50',
                'Title_of_Event/Presentation' => 'required|string|max:255',
                'Venue' => 'required|string|max:255',
                'Prize/place' => 'required|string|max:255',
                'Date' => 'required|date',
                'Document_Link' => 'nullable|url',
                'document' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
            ]);

            // Update fields
            $record['Name_of_student(s)'] = $request->input('Name_of_student(s)');
            $record->Roll_No = $request->input('Roll_No');
            $record->class = $request->input('class');
            $record['Title_of_Event/Presentation'] = $request->input('Title_of_Event/Presentation');
            $record->Venue = $request->input('Venue');
            $record['Prize/place'] = $request->input('Prize/place');
            $record->Date = $request->input('Date');
            $record->Document_Link = $request->input('Document_Link');
            
            

            // Handle file upload only if new file is uploaded
            if ($request->hasFile('document')) {
                // Delete old file if exists
                if ($record->Document && Storage::disk('public')->exists($record->Document)) {
                    Storage::disk('public')->delete($record->Document);
                }

                // Store new file
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName();
                $record->Document = $file->storeAs('SA_Documents/SA_II', $filename, 'public');
            } else {
                // Keep the old file path (nothing changes)
                $record->Document = $record->Document;
            }


            $record->save();

            return redirect()
                ->route('SA.view', ['type' => 'SA_II'])
                ->with('success', 'Student activity updated successfully.');
         }catch (\Exception $e) {
            dd($e->getMessage());
            
        }

            }

            public function u(Request $request, $id)
            {
                return "hi";
            }

   


    

}
