<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    function __construct()
    {
        //  $this->middleware('user-permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        //  $this->middleware('user-permission:role-create', ['only' => ['create','store']]);
        //  $this->middleware('user-permission:role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('user-permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required']]);
        Role::create($validated);
        return to_route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required']]);
        $role->update($validated);
        return to_route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $userRoleId = User::where('role', $id)->first();
        // $userRoleId->detach($id);
        Role::destroy($id);
        return to_route('roles.index');
    }
    public function givePermission(Request $request, Role $role)
    {
        $role->permissions()->syncWithoutDetaching([$request->permission_id], false);
        return back();
    }
    public function revokePermission(Role $role, Permission $permission)
    {
        $role->permissions()->detach($permission);
        return back();
    }
}
