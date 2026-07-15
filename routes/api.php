<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
// En routes/api.php puedes probar esto temporalmente:
Route::get('/prueba', function () {
    return response()->json(['mensaje' => 'Conexión exitosa'])
        ->header('Access-Control-Allow-Origin', '*');
});
