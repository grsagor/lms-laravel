<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->intended('/admin');
        }
        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect(route('login'))->with('success', 'You have been logged out successfully.');
    }
}
