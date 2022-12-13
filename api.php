<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register'] )->name('register');
Route::post('/login', [AuthController::class, 'login' ])->name('login');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/me', [AuthController::class, 'me'] );
    //     curl https://reqbin.com/echo/get/json
    //    -H "Accept: application/json"
    //    -H "Authorization: Bearer {token}"

    // $response = Http::accept('application/json')
    //                 ->withToken('token')
    //                 ->acceptJson()
    //                 ->get('http://example.com/users');

});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/test', [AuthController::class, 'test']);
});

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];

    // foreach ($user->tokens as $token) {
    //     //
    // }

});

