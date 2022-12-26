<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CustomPermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index']);
Route::post('login-custom', [LoginController::class, 'loginCustom'])->name('login.custom');
Route::get('/logout-custom', [LoginController::class, 'logoutCustom'])->name('logout.custom');

// Admin Route
Route::middleware(['auth', 'user-role:admin|user|developer'])->group(function(){
    // new routes
    Route::get('/roles/list', [CustomPermissionController::class, 'roleList'])->name('roles.list');
    Route::get('/roles/create', [CustomPermissionController::class, 'roleCreate'])->name('roles.create');
    Route::post('/roles/store', [CustomPermissionController::class, 'roleStore'])->name('roles.store');
    Route::get('/roles/{role}/edit', [CustomPermissionController::class, 'roleEdit'])->name('roles.edit');
    Route::put('/roles/{role}/update/', [CustomPermissionController::class, 'roleUpdate'])->name('roles.update');
    Route::delete('/roles/{role}/destroy', [CustomPermissionController::class, 'roleDestroy'])->name('roles.destroy');
    Route::post('/roles/{role}/permissions', [CustomPermissionController::class, 'roleGivePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [CustomPermissionController::class, 'roleRevokePermission'])->name('roles.permissions.revoke');
   
    Route::get('/permissions/list', [CustomPermissionController::class, 'permissionList'])->name('permissions.list');
    Route::get('/permissions/create', [CustomPermissionController::class, 'permissionCreate'])->name('permissions.create');
    Route::post('/permissions/store', [CustomPermissionController::class, 'permissionStore'])->name('permissions.store');
    Route::get('/permissions/{permission}/edit', [CustomPermissionController::class, 'permissionEdit'])->name('permissions.edit');
    Route::put('/permissions/{permission}/update/', [CustomPermissionController::class, 'permissionUpdate'])->name('permissions.update');
    Route::delete('/permissions/{permission}/destroy', [CustomPermissionController::class, 'permissionDestroy'])->name('permissions.destroy');
 

    // old routes
    Route::resource('/users', UserController::class);
    // Route::resource('/roles', RoleController::class);
    // Route::resource('/permissions', PermissionController::class);
    // Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions'); 
    // Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke'); 
    // Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles'); 
    // Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove'); 
    Route::get('test', [UserController::class, 'test']); 
});
