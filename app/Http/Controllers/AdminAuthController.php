<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Use the default web guard instead of admin guard
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/populations'); // Redirect to intended page or home
        }

        return Redirect::to('/populations');

   
    }

    public function logout()
    {
        Auth::logout(); // Logout using the default web guard
        return redirect('/');
    }
}
