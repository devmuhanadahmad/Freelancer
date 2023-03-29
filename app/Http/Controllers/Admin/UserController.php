<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(! Gate::allows('user.view')){
            abort(403);
        }
        $request = Request();
        $users = User::Filter($request->query())->latest()->simplePaginate(15);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(! Gate::allows('user.create')){
            abort(403);
        }
        $user = new User();
        return view('admin.user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequist $request)
    {
           if(! Gate::allows('user.create')){
            abort(403);
        }
        User::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'type'=>$request->post('type'),
            'status'=>$request->post('status'),
        ]);
        return redirect()->route('users.index')->with('success', __("Operation accomplished successfully"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('user.update');
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequist $request, User $user)
    {
        Gate::authorize('user.update');
        $user->update([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request->post('password')),
            'type'=>$request->post('type'),
            'status'=>$request->post('status'),
        ]);
        return redirect()->route('users.index')->with('success', __("Operation accomplished successfully"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('user.delete');
        $user->delete();
        return redirect()->route('users.index')->with('success', __("Operation accomplished successfully"));

    }
}
