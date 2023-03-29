<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SoialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        //   $d=Socialite::driver($provider)->user();dd($d);
        DB::beginTransaction();
        try {
            $provider_user = Socialite::driver($provider)->user();
            $user = User::where([
                'provider' => $provider,
                'provider_id' => $provider_user->id,
            ])->first();
            if (!$user) {
                $user = User::create([
                    'name' => $provider_user->name,
                    'email' => $provider_user->email,
                    'password' => Hash::make(Str::random(8)),
                    'provider' => $provider,
                    'provider_id' => $provider_user->id,
                    'provider_token' => $provider_user->token,
                ]);
            }

            Auth::login($user);
            return redirect()->route('home');

            DB::commit();
        } catch (Throwable $e) {
            return redirect()->route('login')->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }

}
