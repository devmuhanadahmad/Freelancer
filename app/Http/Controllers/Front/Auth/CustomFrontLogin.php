<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomFrontLogin extends Controller
{
    public function showFormLogin()
    {
        return view('front.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            // Authentication passed...
        $credentials = $request->only('email', 'password');

            return redirect()->intended('/');
        } else {
            return redirect()->back()->withInput()->with(['error' => 'Invalid login credentials.']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
