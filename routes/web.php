<?php

use App\Http\Controllers\Apps\PermissionController;
use App\Http\Controllers\Apps\RoleController;
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
        Route::resource('/roles', RoleController::class, ['ass' => 'apps'])
        ->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');
    
    });
});