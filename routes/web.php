<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.login');
Route::post('/admin/login/action', [AdminController::class, 'loginAction'])->name('admin.login.action');
Route::get('/admin/g2faverify', [AdminController::class, 'g2faverify'])->name('admin.g2faverify');



Route::post('/2fa', [AdminController::class, 'verifyGoogleAuthenticator'])->name('2fa');

Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\AdminAuth'], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/user-create', [AdminController::class, 'adminUserCreate'])->name('admin.user.create');
    Route::post('/user-store', [AdminController::class, 'adminUserStore'])->name('admin.user.store');
    Route::get('/user-list', [AdminController::class, 'adminUserList'])->name('admin.user.list');

    Route::get('/profile', [AdminController::class, 'dashboard'])->name('admin.profile');

    Route::get('/logout', [AdminController::class, 'logoutAction'])->name('admin.logout');

    Route::get('/complete-registration', [AdminController::class, 'completeRegistration'])->name('complete.registration');
    Route::get('/authantication-registration', [AdminController::class, 'register'])->name('authantication.registration');
});
