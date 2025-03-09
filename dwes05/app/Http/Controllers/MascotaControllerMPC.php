<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Models\MascotaMPC;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;

	class MascotaControllerMPC extends Controller
	{
		// Mostrar formulario de creación de mascotas
		public function mostrarFormularioCrearMascotaMPC()
		{
			return view('privada.formmascotaMPC');
		}

        public function postNuevaMascotaMPC (Request $request)
{
            $datosvalidados = $request->validate([
                'nombre' => 'required|string|max:50',
                'descripcion' => 'required|string|max:250',
                'publica' => 'required|string|in:Si,No',
                'tipo' => 'required|string|in:Perro,Gato,Pájaro,Dragón,Conejo,Hamster,Tortuga,Pez,Serpiente'
            ]);
    	    $nombre = $request->nombre;
			$descripcion = $request->descripcion;
			$tipo = $request->tipo;
			$publica = $request->publica;
            $user_id = auth()->id();
			//$user_id = Auth::user()->id;
			$mascota = new MascotaMPC;
			$mascota->nombre = $nombre;
			$mascota->descripcion = $descripcion;
			$mascota->tipo = $tipo;
			$mascota->publica = $publica;
			$mascota->user_id = $user_id;
			$mascota->save();
            return view('privada.guardarMascotaMPC',['mascota' => $mascota]);
}
		// // Crear mascota
		// public function nuevamascotaMPC(Request $request)
		// {
		// 	$nombre = $request->nombre;
		// 	$descripcion = $request->descripcion;
		// 	$tipo = $request->tipo;
		// 	$publica = $request->publica;
		// 	$user_id = Auth::user()->id;
		// 	$mascota = new MascotaMPC;
		// 	$mascota->nombre = $nombre;
		// 	$mascota->descripcion = $descripcion;
		// 	$mascota->tipo = $tipo;
		// 	$mascota->publica = $publica;
		// 	$mascota->user_id = $user_id;
		// 	$mascota->save();
		// 	return redirect()->route('zonaprivada');
		// }
	}
