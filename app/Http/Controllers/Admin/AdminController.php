<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //

    public function index()
    {
        return view('admin.dashboard');
    }

    public function getUsers(Request $request)
    {
         $perPage = $request->input('per_page', 25);
        $users =user::paginate($perPage)->appends(['per_page' => $perPage]);

        return view('admin.manageUsers',compact('users','perPage'));
    }

    public function getData()
    {
        return view('admin.manageData');
    }


}
