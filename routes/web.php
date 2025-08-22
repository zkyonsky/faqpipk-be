<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout')->middleware('auth');

Auth::routes(['register' => false]);

Route::prefix('admin')->group(function () {

    Route::group(['middleware' => 'auth'], function(){

        //dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');

        //permissions
        Route::resource('/permission', App\Http\Controllers\Admin\PermissionController::class, ['except' => ['show', 'create', 'edit', 'update', 'delete'] ,'as' => 'admin']);

        //roles
        Route::resource('/role', App\Http\Controllers\Admin\RoleController::class, ['except' => ['show'] ,'as' => 'admin']);

        //users
        Route::resource('/user', App\Http\Controllers\Admin\UserController::class, ['except' => ['show'] ,'as' => 'admin']);

        //categories
        Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class, ['except' => 'show' ,'as' => 'admin']);

        //topics
        Route::resource('/topic', App\Http\Controllers\Admin\TopicController::class, ['except' => 'show' ,'as' => 'admin']);

        //problems
        Route::resource('/problem', App\Http\Controllers\Admin\ProblemController::class, ['except' => 'show' ,'as' => 'admin']);

        //cluster
        Route::resource('/cluster', App\Http\Controllers\Admin\ClusterController::class, ['except' => 'show' ,'as' => 'admin']);

        //courses
        Route::resource('/course', App\Http\Controllers\Admin\CourseController::class, ['except' => 'show' ,'as' => 'admin']);
    });

});
