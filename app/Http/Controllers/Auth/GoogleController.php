<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        return Socialite::driver('google')->stateless()->redirect();
    }


public function handleGoogleCallback()
{
    

   
    $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::where('email', $googleUser->getEmail())->first();
    if ($user) {
    auth()->login($user);
    return redirect()->route('dashboard');
               }
        else {
            // User not found — redirect with an error message
            return redirect(route('unauthorized'));
             }

}

}


