<?php

namespace App\Http\Controllers;

use Redirect;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\AdminCreateMail;
use App\Mail\AdminUserRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PragmaRX\Google2FALaravel\Google2FA;

class AdminController extends Controller
{
    //

    public function index()
    {

        session()->forget('g2fakey');

        return view('admin.login');
    }

    public function loginAction(Request $request)
    {

        // dd($request->email);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            // echo "working";

            if (Auth::guard('admin')->user()->google2fa_secret) {
                session(['g2fakey' => Auth::guard('admin')->user()->google2fa_secret]);
                return view('admin.google2fa.index');
            } else {

                return redirect()->route('admin.dashboard');
            }
        } else {

            echo 'Not Working';

            //return redirect()->back();
        }
    }

    //for g2fa

    public function register(Request $request)
    {
        //  $this->validator($request->all())->validate();

        $google2fa = app('pragmarx.google2fa');

        //$registration_data = $request->all();
        // dd(Auth::guard('admin')->user()->email);

        $registration_data['email'] = Auth::guard('admin')->user()->email;

        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();

        $request->session()->flash('registration_data', $registration_data);

        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $registration_data['email'],
            $registration_data['google2fa_secret']
        );

        return view('admin.google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registration_data['google2fa_secret']]);
    }

    public function completeRegistration(Request $request)
    {

        //dd(session('registration_data'));
        // $request->merge(session('registration_data'));

        $userdata = session('registration_data');

        //dd($userdata['email']);

        $usergauth = Admin::where('email', $userdata['email'])->update([

            'google2fa_secret' => $userdata['google2fa_secret'],
        ]);

        return redirect()->back();
    }

    public function g2faverify()
    {

        return view('admin.google2fa.index');
    }

    public function verifyGoogleAuthenticator(Request $request)
    {

        $google2fa = app(Google2FA::class);

        $secret = $request->input('g2fakey');

        $valid = $google2fa->verifyKey($secret, $request->input('one_time_password'));

        if ($valid) {
            // OTP is valid, proceed with your logic
            //return response()->json(['message' => 'OTP verified successfully']);

            session()->forget('g2fakey');


            return redirect()->route('admin.dashboard');
        } else {
            // Invalid OTP, handle accordingly
            return response()->json(['message' => 'Invalid OTP'], 400);
            return redirect()->route('admin.login');
        }
    }

    public function logoutAction(Request $request)
    {

        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }

    public function dashboard(Request $request)
    {

        return view('admin.pages.dashboard');
    }

    public function adminUserList(Request $request)
    {

        $users = Admin::orderBy('id', 'desc')->paginate(10);

        return view('admin.user.list', compact('users'));
    }

    public function adminUserCreate()
    {

        return view('admin.user.create');
    }

    public function adminUserStore(Request $request)
    {

        $validated = $request->validate([

            'name' => 'required|max:255',
            'email' => 'required',
            'type' => 'required|in:"admin", "subadmin"',
            'mobile' => 'required',

        ]);

        $password = Str::random(10);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($password),
            'type' => $request->type,
            'status' => 1,
        ]);


        event(new AdminCreateMail($admin, $password));

        return redirect()->route('admin.user.list');
    }
}
