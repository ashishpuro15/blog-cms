<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/test',function(){
    p("working");
});

Route::post('post/create',[PostController::class,'store']);

Route::get('/post/show',[PostController::class,'index']);

Route::delete('post/delete/{id}',[PostController::class,'destroy']);

Route::post('post/update/{id}',[PostController::class,'update']);