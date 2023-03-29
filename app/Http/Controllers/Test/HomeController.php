<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if($user)
        {
            if($user->type == 'customer')
            {
                return redirect()->route('web.home');
            }

            if($user->type == 'admin')
            {
                return redirect()->route('dashboard');
            }

            if($user->type == 'superadmin')
            {
                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('web.home');


    }
}
