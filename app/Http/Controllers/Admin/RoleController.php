<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('role.view');
        return view('admin.role.index',[
            'roles'=>Role::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('role.create');
        $role =new Role;
        return view('admin.role.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('role.create');
        $request->validate([
            'name'=>'required|string',
            'abilities'=>'required|array'
        ]);

        $role=Role::create($request->all());
        return redirect()->route('role.index')->with('success', __("Role :name created!",[
            'name'=>$role->name
        ]));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('role.update');
        $role=Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('role.update');
        $role=Role::findOrFail($id);
    $request->validate([
        'name'=>'required|string',
        'abilities'=>'required|array'
    ]);
    $role->update($request->all());
    return redirect()->route('role.index')->with('success', __("Role  update!"));
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('role.delate');
        $role=Role::findOrFail($id);
        $role->delete();
        return redirect()->route('role.index')->with('success', __("Role :name delete!",[
            'name'=>$role->name
        ]));
    }
}
