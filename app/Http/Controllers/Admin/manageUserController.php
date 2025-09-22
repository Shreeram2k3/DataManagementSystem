<?php

namespace App\Http\Controllers\Admin;

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
                'pass' => ['required',Rules\Password::defaults()]
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
                
            ]);
            return back()->with('success','User Added Successfully');
        }
        catch(\Exception $e)
        { 
          dd($e);  
            return back()->with('failed','Something went wrong!,Try Again');
        }

    }

    function delete($id)
    {
        $record = user::findOrFail($id);
                $record->delete();

    
                return redirect()->back()->with('delete', 'Record deleted successfully.');
    }

    
}
