<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //

    public function index()
    {
        $totalusers = User::count();
        return view('admin.dashboard', compact('totalusers'));
        return view('admin.dashboard');
    }

    public function getUsers(Request $request)
{
    $perPage = $request->input('per_page', 10);
    $search  = $request->input('search');
   if(Auth::user()->role === 'super_admin')
    {
                $users = User::when($search, function ($query, $search) {
                                $query->where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%");
                            })
                            ->paginate($perPage)
                            ->appends([
                                'per_page' => $perPage,
                                'search'   => $search
                            ]);
            }
    else{
                $users = User::when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->where('department', Auth::user()->department) //  Filter by current user's department
            ->paginate($perPage)
            ->appends([
                'per_page' => $perPage,
                'search'   => $search
            ]);
 
    }

    return view('admin.manageUsers', compact('users', 'perPage', 'search'));
}


    public function getData()
    {
        return view('admin.manageData');
    }


}
