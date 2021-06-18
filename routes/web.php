<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth', 'web'], function () {
    Route::get('/home', [App\Http\Controllers\Front\MainController::class, 'index'])->name('home');

    Route::get('/user', function () {
        return view('welcome');
    });
    Route::prefix('admin')->middleware('can:isAdmin')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        // Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
        // USER MANAGEMENT SYSTEM STARTS HERE
        Route::get('/usermanagement', [App\Http\Controllers\UserManagementController::class, 'allUser']);
        // Create User with Get Command and POST call to ADD USER into our Database
        Route::get('/create', [App\Http\Controllers\UserManagementController::class, 'create']);
        Route::post('/add', [App\Http\Controllers\UserManagementController::class, 'store']);
        // End Here
        // Edit User from User Management System
        Route::get('/edit/{id}', [App\Http\Controllers\UserManagementController::class, 'editUser']);
        Route::post('/update/{id}', [App\Http\Controllers\UserManagementController::class, 'updateUser']);
        // End Here
        Route::delete('delete/{id}', [App\Http\Controllers\UserManagementController::class, 'delete']);
        // USER MANAGEMENT SYSTEM END HERE

        // USER FUNCTIONALITY START HERE
        // Route::get('acounts/details', [App\Http\Controllers\UserController::class, 'editUserDetails']);
        // Edit User from User Management System
        Route::get('/accounts-edits/{id}', [App\Http\Controllers\UserController::class, 'editUserDetails']);
        Route::post('/accounts-update/{id}', [App\Http\Controllers\UserController::class, 'updateUser']);
        // End Here
        // USER FUNCTIONALITY END HERE

        Route::get('/form-upload', [App\Http\Controllers\VideoContentController::class, 'create'])->name('uploadform');
        Route::post('/form-upload', [App\Http\Controllers\VideoContentController::class, 'store'])->name('uploadform');
    });
});
