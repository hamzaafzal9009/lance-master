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
// Public Routes
Route::get('/user/verify/{token}', [App\Http\Controllers\Auth\RegisterController::class, 'verifyUser']);
Route::get('verify/resend', [App\Http\Controllers\Auth\TwoFactorController::class, 'resend'])->name('verify.resend');
Route::resource('verify', App\Http\Controllers\Auth\TwoFactorController::class)->only(['index', 'store']);
Auth::routes();

// Protected Route
Route::group(['middleware' => 'auth', 'web', 'twofactor'], function () {

    Route::get('/home', [App\Http\Controllers\Front\MainController::class, 'index'])->name('home');

    Route::prefix('admin')->middleware('can:isAdmin')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
        Route::get('/usermanagement', [App\Http\Controllers\UserManagementController::class, 'allUser'])->name("allUsers");
        Route::get('/create', [App\Http\Controllers\UserManagementController::class, 'create'])->name("createUser");
        Route::post('/add', [App\Http\Controllers\UserManagementController::class, 'store'])->name("addUser");
        Route::get('/edit/{id}', [App\Http\Controllers\UserManagementController::class, 'editUser'])->name("editUser");
        Route::post('/update/{id}', [App\Http\Controllers\UserManagementController::class, 'updateUser'])->name("updateUser");
        Route::delete('delete/{id}', [App\Http\Controllers\UserManagementController::class, 'delete'])->name("deleteUser");
        Route::get('/accounts-edits/{id}', [App\Http\Controllers\UserController::class, 'editUserDetails'])->name("editUserDetails");
        Route::post('/accounts-update/{id}', [App\Http\Controllers\UserController::class, 'updateUser'])->name("updateUserAccount");

        Route::resource('/categories', App\Http\Controllers\CategoryController::class);

    });

    Route::prefix('user')->group(function () {
        Route::get('/profile/{id}', [App\Http\Controllers\Front\UserController::class, 'index'])->name('user.profile');
        Route::get('/edit-profile/{id}', [App\Http\Controllers\Front\UserController::class, 'editProfile'])->name('user.editProfile');
        Route::post('/edit-profile/{id}', [App\Http\Controllers\Front\UserController::class, 'updateProfile'])->name('user.updateProfile');
        Route::get('/studio', [App\Http\Controllers\Front\UserController::class, 'studio'])->name('user.studio');
        Route::get('/upload', [App\Http\Controllers\Front\UserController::class, 'upload'])->name('user.upload');
        Route::post('/upload', [App\Http\Controllers\Front\UserController::class, 'storeVideo'])->name('user.storeVideo');
        Route::get('/edit-video/{id}', [App\Http\Controllers\Front\UserController::class, 'editVideo'])->name('user.editVideo');
        Route::post('/edit-video/{id}', [App\Http\Controllers\Front\UserController::class, 'updateVideo'])->name('user.updateVideo');
        Route::get('/delete-video/{id}', [App\Http\Controllers\Front\UserController::class, 'deleteVideo'])->name('user.deleteVideo');
    });

    Route::get('/form-upload', [App\Http\Controllers\VideoContentController::class, 'create'])->name('uploadform');
    Route::post('/form-upload', [App\Http\Controllers\VideoContentController::class, 'store'])->name('uploadform');
});
