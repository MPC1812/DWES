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

    public function postNuevaMascotaMPC(Request $request)
    {
        $rules=['nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:250',
            'publica' => 'required|string|in:Si,No',
            'tipo' => 'required|string|in:Perro,Gato,Pájaro,Dragón,Conejo,Hamster,Tortuga,Pez,Serpiente',];
        $customMessages = [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre no puede tener más de 50 caracteres',
            'descripcion.required' => 'La descripción es obligatoria',
            'descripcion.max' => 'La descripción no puede tener más de 250 caracteres',
            'publica.required' => 'Debe seleccionar si la mascota es pública o privada',
            'tipo.required' => 'El tipo es obligatorio y debe ser uno de los que aparecen en la lista',
        ];
        $datosvalidados = $request->validate($rules, $customMessages);
        // $nombre = $request->nombre;
        // $descripcion = $request->descripcion;
        // $tipo = $request->tipo;
        // $publica = $request->publica;
        // $user_id = auth()->id();
        // //$user_id = Auth::user()->id;
        $mascota = new MascotaMPC;
        $mascota->nombre = $request->nombre;
        $mascota->descripcion = $request->descripcion;
        $mascota->tipo = $request->tipo;
        $mascota->publica = $request->publica;
        $mascota->user_id = auth()->id();
        $mascota->save();
        return view('privada.guardarMascotaMPC', ['mascota' => $mascota]);
    }

    public function postBorrarMascotaMPC(Request $request)
    {
        $datosvalidados = $request->validate([
            'id' => 'required|string|max:50',
        ]);
        $id = $request->id;
        $mascota = MascotaMPC::find($id);
        if ((auth()->id()) == ($mascota->user_id)) {
            $mascota->delete();
            return view('privada.borrarmascotaMPC', ['id' => $id]);
        } else {
            return redirect()->route('zonaprivada');
        }
    }
}
