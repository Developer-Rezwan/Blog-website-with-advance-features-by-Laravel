<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Auth\PasswordResetController;
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

/* Admin Routes */

Route::get('/login', [LoginController::class, 'loginView'])->name('login');
Route::post('/login', [LoginController::class, 'loginDataStore']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/forgotten-password', [PasswordResetController::class, 'forgetPasswordView'])->name('forget.password');
Route::post('/forgotten-password', [PasswordResetController::class, 'forgetPasswordProccess']);
Route::post('/verify-phone', [PasswordResetController::class, 'phoneNumberVerificationProcess'])->name('verify-phone');
Route::get('/new-password', [PasswordResetController::class, 'setNewPasswordView'])->name('new.password');
Route::post('/new-password', [PasswordResetController::class, 'storeNewPassword']);


Route::get('/sign-up', [SignUpController::class, 'signUpView'])->name('sign-up');
Route::post('/sign-up', [SignUpController::class, 'signUpDataStore']);
Route::get('/verify-email/{token}', [SignUpController::class, 'verifyEmail'])->name('verify-email');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    require_once('admin.php');
});


/* Website's Routes */
Route::get('/', [PostController::class, 'index'])->name('welcome');

Route::get('/post', function () {
    return view('frontend.post');
});