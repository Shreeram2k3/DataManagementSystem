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
        
        try {
            $validated = $request->validate([
                'date' => 'required|date',
                'name_of_programme' => 'required|string|max:255',
                'speaker_details' => 'required|string|max:255',
                'topic' => 'required|string|max:255',
                'outcome' => 'required|string|max:255',
                'students_participated' => 'required|integer|min:0',
                'document_link' => 'nullable|url'
            ]);
           
          //dd($validated); // For debugging purposes, remove in production
           try{
            SA_I::create([
                'date' => $validated['date'],
                'name_of_programme' => $validated['name_of_programme'],
                'speaker_details' => $validated['speaker_details'],
                'topic' => $validated['topic'],
                'outcome' => $validated['outcome'],
                'students_participated' => $validated['students_participated'],
                'document_link' => $validated['document_link']
            ]);
           
            return redirect()->route('dashboard')->with('success', 'Student activity has entered successfully!');
           }
              catch (\Exception $e) {
                   dd($e->getMessage());
                }
        } catch (\Exception $e) {
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
        //
    }
}
