<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getdashboard()
    {
        return view('user.dashboard');
    }

    public function showstudentactivity()
    {
        return view('user.studentactivity');
    }

    public function showfacultyactivity()
    {
        return view('user.studentactivity');
    }

    public function showdepartmentactivity()
    {
        return view('user.studentactivity');
    }
}
