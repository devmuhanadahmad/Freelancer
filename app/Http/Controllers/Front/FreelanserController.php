<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FreelanserController extends Controller
{
    public function showFreelansers()
    {
        $request = Request();
        $freelansers = User::with('profile')->where('status', 'active')
            ->FilterActive()
            ->FilterNameFreelanserOrJobName($request->query())
            ->latest()
            ->paginate(15, '*', 'page');

        return view('front.showFreelansers', compact('freelansers'));
    }
    public function showFreelanserProfile(User $user)
    {

        $freelanser= User::with('profile')->where('status', 'active')
            ->findOrFail($user->id);
        return view('front.showFreelanserProfile', compact('freelanser'));
    }
}
