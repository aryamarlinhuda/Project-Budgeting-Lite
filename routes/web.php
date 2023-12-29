<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
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

Route::controller(AuthController::class)->group(function() {
    Route::get('/','login_form');
    Route::post('login','login');
    Route::get('/register','register_form');
    Route::post('register','register');
    Route::get('logout','logout');
});

Route::middleware(['user'])->group(function() {
    Route::controller(TransactionController::class)->group(function() {
        Route::get('home','home');
        Route::get('transaction','transaction');
        Route::post('transaction/process','transaction_process');
        Route::get('history','history');
    });

    Route::controller(ProfileController::class)->group(function() {
        Route::get('profile','profile');
        Route::get('delete-photo','delete_photo');
        Route::get('edit-profile','edit_profile');
        Route::post('edit-profile/process','edit_profile_process');
        Route::get('change-password','change_password');
        Route::post('change-password/process','change_password_process');
    });
});