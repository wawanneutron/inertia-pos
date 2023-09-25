<?php

use App\Http\Controllers\Apps\PermissionController;
use App\Http\Controllers\Apps\RoleController;
use App\Http\Controllers\Apps\UserController;
use Illuminate\Support\Facades\Route;

//route home
Route::get('/', function () {
    return \Inertia\Inertia::render('Auth/Login');
})->middleware('guest');

//prefix "apps"
Route::prefix('apps')->group(function() {

    //middleware "auth"
    Route::group(['middleware' => ['auth']], function () {

        //route dashboard
        Route::get('dashboard', App\Http\Controllers\Apps\DashboardController::class)->name('apps.dashboard');

        // route permissions
        Route::get('/permissions', PermissionController::class)
        ->name('apps.permissions.index')
        ->middleware('permission:permissions.index');

        // route resource roles
        Route::resource('/roles', RoleController::class, ['as' => 'apps'])
        ->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');

        // route resource users
        Route::resource('/users', UserController::class, ['as' => 'apps'])
        ->middleware('permission:users.index|users.create|users.edit|users.delete');
    
    });
});