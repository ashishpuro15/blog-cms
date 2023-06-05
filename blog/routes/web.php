<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware'=>'disable_back_btn'],function(){
    Auth::routes();
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('blog/list',[PostController::class,'display']);
    Route::get('blog/create',[PostController::class,'create']);
    Route::get('blog/show/{id}',[PostController::class,'show']);
    Route::get('blog/edit/{id}',[PostController::class,'edit']);
});