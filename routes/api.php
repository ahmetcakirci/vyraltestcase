<?php

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
Route::post("register", [\App\Http\Controllers\API\AuthController::class, "register"]);
Route::post("login", [\App\Http\Controllers\API\AuthController::class, "login"]);

Route::middleware('auth:api')->group(function ($router){
    Route::post("sms_send", [\App\Http\Controllers\API\VerifyController::class, "smsSend"]);
    Route::post("sms_verify", [\App\Http\Controllers\API\VerifyController::class, "smsVerify"]);
    Route::post("email_send", [\App\Http\Controllers\API\VerifyController::class, "emailSend"]);
    Route::post("email_verify", [\App\Http\Controllers\API\VerifyController::class, "emailVerify"]);
    Route::post("post_create", [\App\Http\Controllers\API\PostController::class, "create"]);
    Route::post("post_read", [\App\Http\Controllers\API\PostController::class, "read"]);
    Route::post("post_read_all", [\App\Http\Controllers\API\PostController::class, "readAll"]);
});

Route::post("login", [\App\Http\Controllers\DOC\ProjectsApiController::class, "login"]);

Route::group([
    'prefix' => 'v1',
    'as' => 'api.',
    'namespace' => 'DOC',
    'middleware' => ['auth:api']
], function () {
    Route::apiResource('projects', 'ProjectsApiController');
});
