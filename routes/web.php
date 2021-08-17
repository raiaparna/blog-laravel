<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [PagesController::class, 'index']);
Route::resource('/posts', PostsController::class);
Route::get('/profile/{username}', [UserProfileController::class, 'show']);
Route::get('/profile/{username}/posts', [UserProfileController::class, 'index']);
Route::get('/profile/{username}/edit', [UserProfileController::class, 'edit']);
Route::put('/profile/{username}', [UserProfileController::class, 'update']);

Route::get('change-password', [ChangePasswordController::class, 'index']);
Route::post('change-password', [ChangePasswordController::class, 'changePassword']);
Route::get('update-showcase/{id}', [PostsController::class, 'update_showcase']);
Route::get('admin', [AdminController::class, 'index']);

Route::get('set-admin/{id}', [AdminController::class, 'set_admin']);
Route::get('unset-admin/{id}', [AdminController::class, 'unset_admin']);

Auth::routes();

