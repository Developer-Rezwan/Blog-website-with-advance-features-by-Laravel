<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SubCategoryController;
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
Route::resource('/sub-category', SubCategoryController::class)->except('show');

/*
* Post Routes manages
*/
Route::resource('/post', PostController::class);
Route::get('status/{slug}/{status}', [PostController::class, 'statusUpdate'])->name('post.status');
Route::get('post/published', [PostController::class, 'published'])->name('published.index');
Route::get('post/pending', [PostController::class, 'pending'])->name('pending.index');
Route::get('post/trashed', [PostController::class, 'trashed'])->name('trashed.index');
Route::delete('post/trashed/{id}', [PostController::class, 'trashedToDestroy'])->name('trashed.destroy');
Route::get('post/restore/{slug}', [PostController::class, 'restore'])->name('trashed.restore');

/*
* Users Routes Manager
*/
Route::get('all-users', [UserController::class, 'allUserView'])->name('users.all');

Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('user/trashed', [UserController::class, 'trashed'])->name('user.trashed');
Route::get('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');

Route::get('user/{user}/{notification}', [UserController::class, 'show'])->name('user.show');
Route::get('profile/', [UserController::class, 'profileView'])->name('user.profile');
Route::put('profile/update', [UserController::class, 'profileUpdate'])->name('profile.update');

/*
* Live Chatting routes manager
*/
Route::get('chat', [ChatController::class, 'index'])->name('chat.index');