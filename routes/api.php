<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UrlShortenerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);

Route::middleware("auth:api")->group(function () {
    Route::resource('/url',UrlShortenerController::class);
    Route::get('/ip_redirection',[UrlShortenerController::class,'iPBan'])->middleware('ip_banning');
});