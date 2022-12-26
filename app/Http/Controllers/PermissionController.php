<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Permission;
class PermissionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        //  $this->middleware('user-permission:permission-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        //  $this->middleware('user-permission:permission-create', ['only' => ['create','store']]);
        //  $this->middleware('user-permission:permission-edit', ['only' => ['edit','update']]);
        //  $this->middleware('user-permission:permission-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('permissions.create', compact('roles'));
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
        $permissionId = permission::create($validated);
        $role = Role::where('name', 'admin')->first();
        $role->permissions()->syncWithoutDetaching($permissionId->id, false);
        return to_route('permissions.list');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate(['name' => ['required']]);
        $permission->update($validated);
        return to_route('permissions.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::destroy($id);
        return to_route('permissions.list');
    }
}
