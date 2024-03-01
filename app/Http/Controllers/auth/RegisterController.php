<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        $otp = rand(1000, 9999);
        $user->otp = $otp;
        $user->otp_expired_at = Carbon::now()->addMinutes(2);
        $user->is_verified = 0;

        $body = 'Your One time password is ' . $otp . '. Do not share your one time password to anyone.';
        $subject = 'Registration OTP.';

        if ($user->save()) {
            Mail::to($request->email)->send(new SendEmail($body, $subject));
            session(['user_email' => $user->email]);
            return redirect(route('verify.otp.page'))->with('success', 'Registration was successful');
        } else {
            return back()->with('error', 'Registration was unsuccessful');
        }    
    }

    public function verifyOtpPage() {
        $user_email = session('user_email');
        return view('auth.verify_otp', compact('user_email'));
    }

    public function resendOtp(Request $request) {
        $user = User::where('email', $request->email)->first();

        $otp = rand(1000, 9999);
        $user->otp = $otp;
        $user->otp_expired_at = Carbon::now()->addMinutes(2);
        $user->is_verified = 0;
        $user->save();

        $body = 'Your One time password is ' . $otp . '. Do not share your one time password to anyone.';
        $subject = 'Registration OTP.';
        Mail::to($request->email)->send(new SendEmail($body, $subject));
        return back()->with('success', 'Otp sent again.');
    }

    public function verifyOtp(Request $request) {
        $user = User::where('email', $request->email)->first();
        if ($user->otp == $request->otp) {
            $currentDateTime = Carbon::now();
            $otp_expired_at = Carbon::parse($user->otp_expired_at);
            if ($otp_expired_at->lt($currentDateTime)) {
                return back()->with('error', 'OTP expired.');
            } else {
                $user->is_verified = 1;
                $user->save();
                return redirect(route('login'))->with('success', 'Email verified.');
            }
        } else {
            return back()->with('error', 'Wrong OTP.');
        }
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
        ]);
    }
}
