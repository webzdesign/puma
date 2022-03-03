<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MailOtp;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Faker\Core\Number;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public $route = 'login';
    public $view = 'login';
    public $moduleName = 'login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate(['email' => ['required',],]);
        $user =  User::where('email', $request->email)->first();

        if ($user) {
            $newOtp = rand(100000, 999999);

            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['otp'] = $newOtp;

            // Mail::to($request->email)->send(new MailOtp($data));

            User::where('email', $request->email)->update(['otp' => $newOtp, 'otp_verified' => '0']);
            return redirect('verifyOtp/' . encrypt($user->id));
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.',]);
    }

    public function verifyOtp($id)
    {
        return view('auth.otp', ['id' => $id]);
    }

    public function checkOtp(Request $request, $id)
    {
        $id = decrypt($id);
        $email = User::find($id)->email;
        $otp = User::find($id)->otp;

        if ($email && $otp) {
            if ((int)($request->otp) === $otp) {
                $otpStatus = User::find($id)->update(['otp_verified' => '1']);
                Auth::loginUsingId($id, true);
                return redirect()->intended('dashboard');
            } else {
                $otpStatus = User::find($id)->update(['otp_verified' => '0']);
                return back()->withErrors(['otp' => 'Wrong OTP ! Try Again.',]);
            }
        } else {
            return redirect()->back()->withErrors(['otp' => 'Something Went Wrong !! Try Again',]);
        }
    }


    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
