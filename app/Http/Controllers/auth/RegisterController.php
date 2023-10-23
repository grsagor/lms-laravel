<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm(){
        $user = Auth::user();
        if ($user) {
            return $user;
        }
        return view('auth.register');
    }

    public function register(Request $request){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return back()->with('error','Unsuccessful');
        }
        $user = $this->create($request->all());
        if ($user) {
            return redirect(route('login'))->with('success', 'Registration was successful');
        } else {
            return back()->with('error', 'Registration was unsuccessful');
        }    
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
        ]);
    }

    protected function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
