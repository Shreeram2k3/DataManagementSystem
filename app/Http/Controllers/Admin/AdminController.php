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
    $perPage = $request->input('per_page', 10);
    $search  = $request->input('search');

    $users = User::when($search, function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                })
                ->paginate($perPage)
                ->appends([
                    'per_page' => $perPage,
                    'search'   => $search
                ]);

    return view('admin.manageUsers', compact('users', 'perPage', 'search'));
}


    public function getData()
    {
        return view('admin.manageData');
    }


}
