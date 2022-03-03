<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MailOtp;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use DateInterval;
use DateTime;
use Faker\Core\Number;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public $route = 'login';
    public $view = 'login';
    public $moduleName = 'Login';

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
        $moduleName = $this->moduleName;
        return view('auth.login', compact('moduleName'));
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

            User::where('email', $request->email)->update(['otp' => $newOtp, 'otp_expire' => date('Y-m-d H:i:s', strtotime('now'))]);
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
        $user = User::where('id', $id)->first();
        $email = $user->email;
        $otp = $user->otp;

        if ($email && $otp) {
            $otpExpire = strtotime($user->otp_expire);
            $expired_at = $otpExpire + (int)(60 * 5); //5 min
            $now = strtotime('now');

            if ($now < $expired_at) {
                if ((int)($request->otp) === $otp) {
                    $update = User::where('id', $id)->update(['otp' => null, 'otp_expire' => null]);
                    Auth::loginUsingId($id, true);
                    return redirect()->intended('home');
                } else {
                    return back()->withErrors(['otp' => 'Wrong OTP ! Try Again.',]);
                }
            } else {
                $update = User::where('id', $id)->update(['otp' => null, 'otp_expire' => null]);
                return redirect(route('login'))->with(['expired' => 'Your Otp Is Expired ! Resend Again',]);
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
