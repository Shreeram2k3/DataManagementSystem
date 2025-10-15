<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;


use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;


class manageUserController extends Controller
{
    

    function store(Request $request)
    {
        try
        {
             try{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'role' =>'required|string',
                'pass' => ['required',Rules\Password::defaults()],
                'department' =>'required|string',
            ]);
        }
        catch(ValidationException $e)
        { 

             $errors = $e->validator->errors()->messages();

     foreach ($errors as $field => $messages) 
        {
           if ($field === 'email') {
            return back()->with('failed', 'Error: This email is already registered!,Try again');
        }

        if ($field === 'name') {
            return back()->with('failed', 'Error: Name field is required!');
        }

        if ($field === 'pass') {
            return back()->with('failed', 'Error: Password is too weak!,Use min 8 Characters');
        }
     }
    
        }

            //dd($request);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->pass),
                'department' => $request->department,
                
            ]);
            return back()->with('success','User Added Successfully');
        }
        catch(\Exception $e)
        { 
        //   dd($e);  
            return back()->with('failed','Something went wrong!,Try Again');
        }

    }

    function delete($id)
    {
        $record = user::findOrFail($id);
        if($record->role === 'super_admin')
        {
             return back()->with('failed','Sorry you can\'t delete the admin');
        }
        elseif($record->id === Auth::user()->id){
         return back()->with('failed','Sorry you can\'t delete because you are admin');
     }
        else{
        $record = user::findOrFail($id);
                $record->delete();

    
                return redirect()->back()->with('delete', 'Record deleted successfully.');
        }
    }


   // Show edit form
public function edit($id)
{
     $record = user::findOrFail($id);
     if($record->role === 'super_admin')
     {
         return back()->with('failed','Sorry you can\'t edit because you are super admin');
     }
     elseif($record->id === Auth::user()->id){
         return back()->with('failed','Sorry you can\'t edit because you are admin');
     }
     
     else{
    $record = User::findOrFail($id); // user to edit
    $users = User::paginate(25);     // still show table data
     $perPage = request()->get('per_page', 25);
  

    return view('admin.manageUsers', compact('record', 'users','perPage'));
     }
}

// Update record
public function update(Request $request, $id)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role'  => 'required',
        'department' => 'required|string',
    ]);

    $user = User::findOrFail($id);
    $user->name  = $request->name;
    $user->email = $request->email;
    $user->role  = $request->role;
    $user->department = $request->department;

    if ($request->filled('pass')) {
        $user->password = bcrypt($request->pass);
    }

    $user->save();

    return redirect()->route('admin.manageUsers')->with('success', 'User updated successfully!');
}


    
}
