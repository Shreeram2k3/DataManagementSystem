<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index()
    {
        return view('admin.dashboard');
    }

    public function getUsers()
    {
        return view('admin.manageUsers');
    }

    public function getData()
    {
        return view('admin.manageData');
    }


}
