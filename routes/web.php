<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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
    return redirect(route('home.index'));
});

Route::resource('message', 'MessageController');
Route::resource('customer', 'CustomerController');
Route::resource('log', 'LogController');
Route::resource('category', 'CategoryController');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::post('/home/send',[HomeController::class, 'send'])->name('home.send');

Route::get('/login',[UserController::class, 'getLogin'])->name('user.getLogin');
Route::post('/login',[UserController::class, 'postLogin'])->name('user.postLogin');
Route::get('/logout',[UserController::class, 'logout'])->name('user.logout');
