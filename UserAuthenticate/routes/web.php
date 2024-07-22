<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
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
    return view('welcome');
});

//signup
Route::view('signup','signup');
Route::post('register', [UserController::class, 'register'])->name('register');

//login
Route::view('signin','signin');
Route::post('login', [UserController::class, 'login']);



//session
Route::get('/signin',function()
{
    if(session()->has('user')){
        return redirect('dashboard');
    }
    return view('signin');
});

Route::get('logout',function()
{
    if(session()->has('user')){
        session()->pull('user');
    }
    return redirect('signin');
});

Route::view('dashboard','dashboard' )->middleware('protectedPage');


Route::get('/todo/tasks', [TaskController::class, 'getTasks']);


