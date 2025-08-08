<?php

namespace App\Http\Controllers\StudentsActivityController;

use App\Models\StudentsActivityModels\SA_I;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class SA_IController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // these are the name attribute in form 
        $type = 'SA_I';
        try {
            $validated = $request->validate([
                'date' => 'required|date',
                'name_of_programme' => 'required|string|max:255',
                'speaker_details' => 'required|string|max:255',
                'topic' => 'required|string|max:255',
                'outcome' => 'required|string|max:255',
                'students_participated' => 'required|integer|min:0',
                'document_link' => 'nullable|url',
                'document' => 'required|file|mimes:pdf,doc,docx|max:5120'
                
            ]);
            // Automatically set the user_id to the authenticated user's ID
            $validated['user_id'] = auth()->id();
           if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName(); //adding timestamp to avoid collisions
                $validated['document'] = $file->storeAs('SA_Documents/SA_I', $filename, 'public');
            }

        //   dd($validated); // For debugging purposes, remove in production
           try{

            // left side column name in table, right side name attribute in form 
            SA_I::create([
                'date' => $validated['date'],
                'name_of_programme' => $validated['name_of_programme'],
                'speaker_details' => $validated['speaker_details'],
                'topic' => $validated['topic'],
                'outcome' => $validated['outcome'],
                'students_participated' => $validated['students_participated'],
                'document_link' => $validated['document_link'],
                'Document'=>$validated['document'],
                
                
                'user_id' => $validated['user_id']
            ]);
           
            return redirect( route('SA.view', ['type' => $type]))->with('success', 'Student activity created successfully.');
           }
              catch (\Exception $e) {
                   dd($e->getMessage());
                }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create student activity: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = SA_I::findOrFail($id);
        $activity->delete(); // This triggers the boot model event
        return redirect()->back()->with('success', 'Student activity deleted successfully.');
    }

}
