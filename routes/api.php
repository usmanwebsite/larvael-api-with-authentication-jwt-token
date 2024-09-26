<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;

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


Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login',[AuthController::class,'login']);
   Route::post('register',[AuthController::class,'register']);
});

Route::middleware(['api'])->group(function(){
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::get('me', [AuthController::class,'me']);

    Route::get('start',[ItemController::class,'view']);
    Route::resource('items', ItemController::class);
});

// old token   //eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MjQxMzYyMTQsImV4cCI6MTcyNDEzOTgxNCwibmJmIjoxNzI0MTM2MjE0LCJqdGkiOiJZbVlRSFlSazBUV0doNmNOIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.rPVYOacPVyalbf4FoLRlPn0unxb1KZxm__R14dYFGuE

// new token //eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZnJlc2giLCJpYXQiOjE3MjQxMzYyMTQsImV4cCI6MTcyNDE0MDIwOSwibmJmIjoxNzI0MTM2NjA5LCJqdGkiOiJBbmNqRFVFemNGRzhzYWhoIiwic3ViIjoiMyIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.Sezs9qlAz3n3q65mSXeRvx8WTq2OPWH4QNYHOfcXwdk