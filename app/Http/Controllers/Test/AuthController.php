<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function login()
    {

        $data = $this->request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ], [
            'email.required' => "يا حبيب ادخلي الايميل ",
            "password.required" => 'ادخل كلمة السر',
        ]);
        $user = User::where('email', $data['email'])->first();
        if ($user) {
        

            if (Hash::check($data['password'], $user->password)) {
                Auth::login($user);
                return redirect()->route('home');
            }
        }

        return redirect()->back()->with('message', 'error');
    }

    public function register()
    {
        $data = $this->request->validate([
            'email' => ['required'],
            'password' => ['required', 'confirmed'],
            'name' => ['required'],
        ], [
            'email.required' => "يا حبيب ادخلي الايميل ",
            "password.required" => 'ادخل كلمة السر',
            "password.confirmed" => 'الكلمات غير متطابقة',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'active',
            'type' => 'customer',
        ]);

        Auth::login($user);

        return redirect()->route('home');

    }

    public function loginForm()
    {
        return view('front.auth.login');
    }
    public function registerForm()
    {
        return view('front.auth.register');
    }

    public function logout()
    {
        Auth::logout();
        //dd('f');
        return redirect()->route('web.home');
    }
}
