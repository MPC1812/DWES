<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Models\MascotaMPC;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MascotaControllerMPC;

//Ruta a la zona pública (simplemente accediendo a / vía GET)
Route::get('/', function () {
    return view('principal');
})->name('zonapublica');

//Ruta a la zona privada (simplemente accediendo a /zonaprivada vía GET)
Route::get('/zonaprivada', function () {
    return view('privada.principal');
})->middleware('auth')->name('zonaprivada');

//Creamos una ruta nombrada (formlogin) tipo GET a '/login' que mostrará el formulario
Route::get('/login', [LoginController::class, 'mostrarFormularioLoginMPC'])->name('formlogin');
//Creamos una ruta nombrada (login) tipo POST a '/login' que procesará el formulario
Route::post('/login', [LoginController::class, 'loginMPC'])->name('login');
//Creamos una ruta nombrada (logout) tipo POST a '/logout' que cerrará la sesión
Route::get('/logout', [LoginController::class, 'logoutMPC'])->name('logout');
//Ruta a la zona pública (simplemente accediendo a / vía GET)
Route::get('/', function () {
    $mascotas = MascotaMPC::where('publica', 'Si')->get(); //Obtener el listado de mascotas públicas
    return view('principal', ['mascotasMPC'=>$mascotas]);
})->name('zonapublica');
//Ruta a la zona privada (simplemente accediendo a /zonaprivada vía GET)
Route::get('/zonaprivada', function () {
    $mascotas = MascotaMPC::where('user_id', Auth::user()->id)->get(); //Obtener el listado de mascotas del usuario
    return view('privada.principal',['mascotasMPC' => $mascotas]);
})->middleware('auth')->name('zonaprivada');

route::controller(MascotaControllerMPC::class)->middleware('auth')->group(function () {
    //Ruta para mostrar el formulario de creación de mascotas
    Route::get('/mascota/nueva', [MascotaControllerMPC::class, 'mostrarFormularioCrearMascotaMPC'])->name('formmascotaMPC');
    //Ruta post donde se procesa el formulario de creación de mascotas
    Route::post('/mascota/nueva', [MascotaControllerMPC::class, 'postNuevaMascotaMPC'])->name('nuevamascotaMPC');
    //Ruta post para borrar mascotas
    Route::post('/mascota/borrar', [MascotaControllerMPC::class, 'postBorrarMascotaMPC'])->name('borrarmascotaMPC');
});

/* 
Otra forma de hacer lo anterior
//Ruta para mostrar el formulario de creación de mascotas
Route::get('/mascota/nueva', [MascotaControllerMPC::class, 'mostrarFormularioCrearMascotaMPC'])->middleware('auth')->name('formmascotaMPC');
//Ruta post donde se procesa el formulario de creación de mascotas
Route::post('/mascota/nueva', [MascotaControllerMPC::class, 'postNuevaMascotaMPC'])->middleware('auth')->name('nuevamascotaMPC');
//Ruta post para borrar mascotas
Route::post('/mascota/borrar', [MascotaControllerMPC::class, 'postBorrarMascotaMPC'])->middleware('auth')->name('borrarmascotaMPC');
*/