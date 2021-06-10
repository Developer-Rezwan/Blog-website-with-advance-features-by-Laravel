<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

/*
* Dashboard Controller
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

/*
* Category Controller
*/
Route::resource('/category', CategoryController::class)->except('show');

/*
* Post Routes manages
*/
Route::resource('/post', PostController::class);
Route::prefix('post')->name('post.')->group(function () {
    Route::get('/status/{slug}/{status}', [PostController::class, 'statusUpdate'])->name('status');
    Route::get('all/published', [PostController::class, 'published'])->name('published');
    Route::get('all/pending', [PostController::class, 'pending'])->name('pending');
    Route::get('all/trashed', [PostController::class, 'trashed'])->name('trashed');
    Route::delete('/trashed/{id}', [PostController::class, 'trashedToDestroy'])->name('delete');
    Route::get('/restore/{slug}', [PostController::class, 'restore'])->name('restore');
});
/*
* Users Routes Manager
*/
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/all-users', [UserController::class, 'allUserView'])->name('all');
    Route::get('/add-new', [UserController::class, 'create'])->name('add-new');
    Route::post('/add-new', [UserController::class, 'store']);

    Route::get('/admins', [UserController::class, 'admins'])->name('admins');
    Route::get('/authors', [UserController::class, 'authors'])->name('authors');
    Route::get('/contributors', [UserController::class, 'contributors'])->name('contributors');

    Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/trashed', [UserController::class, 'trashed'])->name('trashed');
    Route::get('/{id}/restore', [UserController::class, 'restore'])->name('restore');
    Route::delete('/{id}/delete', [UserController::class, 'permanentlyDelete'])->name('delete');

    Route::get('/{id}/show/{notification?}', [UserController::class, 'show'])->name('show');

    Route::get('/my/profile', [UserController::class, 'profileView'])->name('profile');
    Route::put('/profile/{id}/update', [UserController::class, 'profileUpdate'])->name('profile.update');
});
/*
* Live Chatting routes manager
*/
Route::prefix('chat')->name('chat.')->group(function () {
    Route::post('/', [ChatController::class, 'processData']);
    Route::get('/{id}/show', [ChatController::class, 'index'])->name('index');
    Route::get('/fetchMessages/{sender}/{reciever}', [ChatController::class, 'fetchMessages'])->whereNumber(['sender', 'reciever']);
    Route::get('/fetchLastMessage/{sender}/{reciever}', [ChatController::class, 'fetchLastMessage'])->whereNumber(['sender', 'reciever']);
});
