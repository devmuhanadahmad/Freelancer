<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser as ModelsRoleUser;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUser extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleuser=ModelsRoleUser::all();
        return view('admin.roleuser.index',compact('roleuser'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role=Role::all();
        $user=User::all();
        $roleuser = new ModelsRoleUser();
        return view('admin.roleuser.create', compact('roleuser','role','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=Role::all();
        $user=User::all();
        $roleuser=ModelsRoleUser::findOrFail($id);
        return view('admin.roleuser.edit', compact('roleuser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roleuser=ModelsRoleUser::findOrFail($id);
        $roleuser->delete();
        return redirect()->route('role.index')->with('success', __("success deleted"));
    }
}
