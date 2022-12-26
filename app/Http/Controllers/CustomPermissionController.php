<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Permission;
class CustomPermissionController extends Controller
{
    function __construct()
    {
         $this->middleware('user-permission:role-list|role-create|role-edit|role-delete', ['only' => ['roleList','roleStore']]);
         $this->middleware('user-permission:role-create', ['only' => ['roleCreate','roleStore']]);
         $this->middleware('user-permission:role-edit', ['only' => ['roleEdit','roleUpdate']]);
         $this->middleware('user-permission:role-delete', ['only' => ['roleDestroy']]);

        //  $this->middleware('user-permission:permission-list|role-create|role-edit|role-delete', ['only' => ['permissionList','permissionStore']]);
        //  $this->middleware('user-permission:permission-create', ['only' => ['permissionCreate','permissionStore']]);
        //  $this->middleware('user-permission:permission-edit', ['only' => ['permissionEdit','permissionUpdate']]);
        //  $this->middleware('user-permission:permission-delete', ['only' => ['permissionDestroy']])
    }
    public function roleList()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }
    public function roleCreate()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }
    public function roleStore(Request $request)
    {
        $validated = $request->validate(['name' => ['required']]);
        Role::create($validated);
        return to_route('roles.list');
    }
    public function roleEdit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }
    public function roleUpdate(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required']]);
        $role->update($validated);
        return to_route('roles.list');
    }
    public function roleDestroy($id)
    {
        $userRoleId = User::where('role', $id)->first();
        if($userRoleId)
        {
            return 0;
        } else {
            // $userRoleId->detach($id);
            // Role::destroy($id);
        }
        return to_route('roles.list');
    }
    public function roleGivePermission(Request $request, Role $role)
    {
        $role->permissions()->syncWithoutDetaching([$request->permission_id], false);
        return back();
    }
    public function roleRevokePermission(Role $role, Permission $permission)
    {
        $role->permissions()->detach($permission);
        return back();
    }
    public function permissionList()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissionCreate()
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
    public function permissionStore(Request $request)
    {
        $validated = $request->validate(['name' => ['required']]);     
        $permissionId = permission::create($validated);
        $role = Role::where('name', 'admin')->first();
        $role->permissions()->syncWithoutDetaching($permissionId->id, false);
        return to_route('permissions.list');
    }

    public function permissionEdit(Permission $permission)
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
    public function permissionUpdate(Request $request, Permission $permission)
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
    public function permissionDestroy($id)
    {
        // Permission::destroy($id);
        return to_route('permissions.list');
    }
}
