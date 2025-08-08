<?php

namespace App\Http\Controllers\StudentsActivityController;
use App\Models\StudentsActivityModels\SA_I;
use App\Models\StudentsActivityModels\SA_II;
use App\Models\StudentsActivityModels\SA_III;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SAdatapageController extends Controller
{
     public function Select_form($type)
    {
       // to ckeck that the given type is consist of that type
       $validTypes = [
            'SA_I',
            'SA_II',
            'SA_III',
             
       ];
       // Get the user ID from the authenticated user
       $userId = auth()->id();
       if ($type === 'SA_I')  
                { 
                    $data['SA_I'] = SA_I::where('user_id', $userId)->get();
                }
         else if ($type === 'SA_II')  
                {
                    $data['SA_II'] = SA_II::where('user_id', $userId)->get();
                }
         else if ($type === 'SA_III')  
                {
                    $data['SA_III'] = SA_III::where('user_id', $userId)->get();
                }
// -----------------------------------------------------------------------------------------------------------------
         // Check if the type is valid and return the corresponding view
                if (in_array($type, $validTypes)) {
                    return view('user.Studentdatapage',compact('type','data'));
                } else {
                    return "The form not exists";
                }
    }
    //---------------destroy function-----------------------------------------------------------------------
    public function destroy($type, $id)
    {
                    try {
                    $modelMap = [
                    'SA_I' => SA_I::class,
                    'SA_II' => SA_II::class,
                    'SA_III' => SA_III::class,
                ];

        
                    $modelClass = $modelMap[$type];
                    $record = $modelClass::findOrFail($id);
                    $record->delete();

        
                    return redirect()->back()->with('delete', 'Record deleted successfully.');
                }
                     catch (\Exception $e) {
                        dd($e->getMessage());
   
             }
    }

    //---------------edit and update function-----------------------------------------------------------------------
        public function edit($type, $id)
        {               
            try {
                            $modelMap = [
                                'SA_I' => SA_I::class,
                                'SA_II' => SA_II::class,
                                'SA_III' => SA_III::class,
                            ];

                            

                            $model = $modelMap[$type];
                            $record = $model::find($id);
                          
    // Fetch the list again for table display
                            $userId = auth()->id();
                            $data[$type] = $model::where('user_id', $userId)->get();

                            return view('user.Studentdatapage', compact('type', 'data', 'record'));
        }
        catch (\Exception $e) {
                   dd($e->getMessage());
                }
    }
    //---------------update function-----------------------------------------------------------------------

         public function update(Request $request, $type, $id)
            {
                        $modelMap = [
                            'SA_I' => SA_I::class,
                            'SA_II' => SA_II::class,
                            // 'SA_III' => SA_III::class,
                        ];
                        
                        if (!isset($modelMap[$type])) {
                            return redirect()->back()->with('error', 'Invalid type.');
                        }

                        $model = $modelMap[$type];
                        $record = $model::find($id);

                        if (!$record || $record->user_id !== auth()->id()) {
                            return redirect()->back()->with('error', 'Record not found or unauthorized.');
                        }

                        // Validate the request data based on the type
                        if ($type === 'SA_I') {
                            $request->validate([
                                'name_of_programme' => 'required|string|max:255',
                                'topic' => 'required|string|max:255',
                                'date' => 'required|date',
                                'speaker_details' => 'required|string',
                                'outcome' => 'required|string',
                                'students_participated' => 'required|integer',
                                'document_link' => 'nullable|url',
                            ]);
                            dd($request->all());

                            $record->update([
                                'name_of_programme' => $request->name_of_programme,
                                'topic' => $request->topic,
                                'date' => $request->date,
                                'speaker_details' => $request->speaker_details,
                                'outcome' => $request->outcome,
                                'students_participated' => $request->students_participated,
                                'document_link' => $request->document_link,
                            ]);
                        }
                        else if($type === 'SA_II')
                        {
                            $request->validate([
                                'Name_of_student(s)' => 'required|string|max:255',
                                'Roll_No' => 'required|string|max:50',
                                'class' => 'required|string|max:50',
                                'Title_of_Event/Presentation' => 'required|string|max:255',
                                'Venue' => 'required|string|max:255',
                                'Prize/place' => 'required|string|max:255',
                                'Date' => 'required|date',
                                'Document_Link' => 'nullable|url'
                            ]);
                            

                            $record->update([
                                        'Name_of_student(s)' => $request['Name_of_student(s)'],
                                        'Roll_No' => $request['Roll_No'],
                                        'class' => $request['class'],
                                        'Title_of_Event/Presentation' => $request['Title_of_Event/Presentation'],
                                        'Venue' => $request['Venue'],
                                        'Prize/place' => $request['Prize/place'],
                                        'Date' => $request['Date'],
                                        'Document_Link' => $request['Document_Link']
                                 ]);
                        }

                        // Repeat for SA_II & SA_III validations

                        return back()->route('SA.view', ['type' => $type])
                                        ->with('success', 'Record updated successfully.');
                    }
      

        

}
