<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Container\Attributes\Auth;

Route::get('/about', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('login');
});

Route::post('/', [AuthController::class, 'store']);

route::controller(AuthController::class)->middleware('auth')->group(function () {
    //
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
    Route::get('/register', function () {
        return view('auth.register');
    });
    Route::get('/avisos', function(){
        return view('plantillas.avisos');
    });
    Route::post('/register', [AuthController::class, 'guardarNuevoUsuario']);
    Route::get('/logout', [AuthController::class, 'destroy']);

    Route::get('/newJob', [AuthController::class, 'newJob']->name('nuevoParte'));
    Route::get('/newJob', [AuthController::class, 'newJob']->name('nuevoParte'));
});


/*
Route::get('/dashboard', [AuthController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/register', [AuthController::class, 'create'])->middleware('auth');
Route::post('/register', [AuthController::class, 'guardarNuevoUsuario'])->middleware('auth');

//Route::post('/login', [AuthController::class, 'index']);

Route::get('/register', function () {
    return view('auth.register');
});



Route::post('/register', [AuthController::class, 'guardarNuevoUsuario'])->middleware('auth');

Route::get('/logout', [AuthController::class, 'destroy'])->middleware('auth');

Route::post('/recuperar-password', [AuthController::class, 'forgotPassword'])->name('recuperar-password');
Route::post('/forgot-password/{token}', [AuthController::class, 'resetPassword'])->name('reset-password');


// Route::group(['middleware' => ['Authenticated']], function () {

//     Route::get('/register', [AuthController::class, 'create'])->name('create');
// });
*/