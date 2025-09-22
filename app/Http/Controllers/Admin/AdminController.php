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

    public function getUsers()
    {
        $users =user::all();
        return view('admin.manageUsers',compact('users'));
    }

    public function getData()
    {
        return view('admin.manageData');
    }


}
