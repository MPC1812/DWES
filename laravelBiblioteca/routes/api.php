<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Api;
use App\Http\Controllers\ApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/libros', [ApiController::class, 'index']);
Route::post('/libros', [ApiController::class, 'store']);
Route::delete('/libros/{id}', [ApiController::class, 'destroy']);