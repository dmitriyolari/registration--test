<?php

use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserController::class, 'createForm'])->name('user.create.form');
    Route::post('/register', [UserController::class, 'create'])->name('user.create');

    Route::get('/login', [UserController::class, 'loginForm'])->name('user.login.form');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/structure', [UserController::class, 'showStructure'])->name('user.structure');
    Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

    Route::get('/register/child', [UserController::class, 'createFormChild'])->name('user.create.child.form');
    Route::post('/register/child', [UserController::class, 'createChild'])->name('user.create.child');
});
