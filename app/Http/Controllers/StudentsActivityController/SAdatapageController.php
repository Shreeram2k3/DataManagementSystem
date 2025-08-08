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
    public function destroy($type, $id)
        {
        $modelMap = [
        'SA_I' => SA_I::class,
        'SA_II' => SA_II::class,
        'SA_III' => SA_III::class,
    ];
       $model = $modelMap[$type];
       $record = $model::find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'Record not found.');
        }
        // Check if the record belongs to the authenticated user
        if ($record->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You do not have permission to delete this record.');
        }
        // Delete the record
       $record->delete();
        if (!$record) {
        return ('error');
        }
      return redirect()->back()->with('delete', 'Record deleted successfully.');

   
        }
        public function edit($type, $id)
        {
        $modelMap = [
            'SA_I' => SA_I::class,
            'SA_II' => SA_II::class,
            'SA_III' => SA_III::class,
        ];

        if (!isset($modelMap[$type])) {
            return redirect()->back()->with('error', 'Invalid type.');
        }

        $model = $modelMap[$type];
        $record = $model::find($id);

        if (!$record || $record->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Record not found or unauthorized.');
         }

    // Fetch the list again for table display
                    $userId = auth()->id();
                    $data[$type] = $model::where('user_id', $userId)->get();

                     return view('user.Studentdatapage', compact('type', 'data', 'record'));
                }

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

                        // Example for SA_I — adjust fields for other types
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

                        return redirect()->route('SA.view', ['type' => $type])
                                        ->with('success', 'Record updated successfully.');
                    }


        

}
