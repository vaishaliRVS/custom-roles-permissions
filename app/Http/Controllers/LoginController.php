<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        if (!Auth::check()) 
        {
            return view('login');
        }
        else
        {
            return redirect()->intended('users');
        }
    }
    public function loginCustom(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); 
            return redirect()->intended('users');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logoutCustom() {
        Session::flush();
        Auth::logout();  
        return Redirect('/');
    }
}
