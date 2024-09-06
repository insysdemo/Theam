<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleHasPermissionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/', 'admins.auth.login');
Route::view('/admin', 'admins.auth.login');
Route::view('/login', 'admins.auth.login');
Route::group(['prefix' =>'admin'],function(){
 
Route::get('/login',[AuthController::class,'loginForm'])->name('login');
Route::post('login',[AuthController::class,'checkLogin'])->name('admin.login');

});
// Route::middleware(['auth:admin'])->group(function () {
//     Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
//     Route::middleware(['can:Role access,App\Models\Role'])->resource('roles',RoleController::class);
// });
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::middleware(['can:Role access,Spatie\Permission\Models\Permission'])->resource('roles', RoleController::class);
    Route::post('roles/list', [RoleController::class, 'list']);



    Route::middleware(['can:Permission access,Spatie\Permission\Models\Permission'])->resource('permissions', PermissionController::class);
    Route::post('permissions/list', [PermissionController::class, 'list']);
    Route::post('permissions/multidestroy', [PermissionController::class, 'multidestroy'])->name('permissions.multidestroy');

    Route::middleware(['can:Rolehaspermission access,App\Models\RoleHasPermission'])->resource('role-has-permission', RoleHasPermissionController::class);
    Route::post('role-has-permission/list', [RoleHasPermissionController::class, 'list']);

    Route::middleware(['can:Users access,Spatie\Permission\Models\Permission'])->resource('users',UserController::class);
    Route::post('users/list', [UserController::class, 'list']);
});