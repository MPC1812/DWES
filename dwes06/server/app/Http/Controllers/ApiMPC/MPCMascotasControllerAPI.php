<?php

namespace App\Http\Controllers\ApiMPC;

use App\Http\Controllers\Controller;
//Clases que necesitamos para que funcione el controlador 
use App\Models\MascotaMPC;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class MPCMascotasControllerAPI extends Controller
{
    public function listarMascotasMPC()
    {
        $mascotas = MascotaMPC::where('user_id', Auth::user()->id)->get(); //Obtener el listado de mascotas del usuario
        $arraycount = count($mascotas);
        $i = 0;
        while ($i < $arraycount) {
            $newmascotas[$i]['id'] = $mascotas[$i]['id'];
            $newmascotas[$i]['nombre'] = $mascotas[$i]['nombre'];
            $newmascotas[$i]['descripcion'] = $mascotas[$i]['descripcion'];
            $newmascotas[$i]['tipo'] = $mascotas[$i]['tipo'];
            $newmascotas[$i]['megustas'] = $mascotas[$i]['megusta'];
            $i++;
        }
        return response()->json($newmascotas);
    }

    public function crearmascotaMPC(Request $request)
    {
        $customMessages = [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre no puede tener más de 50 caracteres',
            'descripcion.required' => 'La descripción es obligatoria',
            'descripcion.max' => 'La descripción no puede tener más de 250 caracteres',
            'publica.required' => 'Debe seleccionar si la mascota es pública o privada',
            'publica.in' => 'Sólo puede contener el valor Si para pública o No para privada',
            'tipo.required' => 'El tipo es obligatorio y debe ser uno de los que aparecen en la lista',
            'tipo.in' => 'Sólo puede contener el valor Perro, Gato, Pájaro, Dragón, Conejo, Hamster, Tortuga, Pez o Serpiente',
        ];

        $validator = Validator::make($request->only(['nombre', 'descripcion', 'tipo', 'publica']), [
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:250',
            'publica' => 'required|string|in:Si,No',
            'tipo' => 'required|string|in:Perro,Gato,Pájaro,Dragón,Conejo,Hamster,Tortuga,Pez,Serpiente',
        ], $customMessages);

        /* Si los datos no son válidos, muestra un mensaje de error, los errores encontrados y el código de error 400
        * Si los datos son válidos, crea la mascota y devuelve un mensaje de éxito
        */
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $errores[] = $error;
            }
            return response()->json(['mensaje' => 'Datos incorrectos', 'errores' => $errores], 400);
        }
        $mascota = new MascotaMPC;
        $mascota->nombre = $request->nombre;
        $mascota->descripcion = $request->descripcion;
        $mascota->tipo = $request->tipo;
        $mascota->publica = $request->publica;
        $mascota->user_id = auth()->id();
        $mascota->save();
        return response()->json(['id_mascota' => $mascota->id, 'implementador' => auth()->user()->name]);
    }

    public function cambiarMascotaXYZ(int $mascota, Request $request)
    {
        if ($request -> isJson()) {
        $request->json()->all();
        $mascota = MascotaMPC::find($mascota);
        if (isNull($mascota)) {
            return response()->json('Data not found', 404);
        } elseif ($mascota->user_id != auth()->id()) {
            return response()->json('No tienes permisos para realizar esta acción', 403);
        } elseif ($mascota->user_id == auth()->id()) {
            //FALTA TRATAR EL JSON RECIBIDO Y MODIFICAR LA MASCOTA
            $mascota->nombre = $request->nombre;
            $mascota->descripcion = $request->descripcion;
            $mascota->tipo = $request->tipo;
            $mascota->publica = $request->publica;
            $mascota->save();
            return response()->json(['mensaje' => 'Cambio realizado', 'id_mascota' => $mascota->id, 'implementador' => auth()->user()->name]);
        } else {
            return response()->json(['mensaje' => 'No se pudo realizar el cambio', 'id_mascota' => $mascota->id, 'implementador' => auth()->user()->name]);
        }
    } else {
        return response()->json('Datos recibidos incorrectos, se esperaba un JSON', 400);
    }
    }

    public function eliminarMascotaXYZ(int $mascota)
    {
        $mascota = MascotaMPC::find($mascota);
        if (isNull($mascota)) {
            return response()->json('Data not found', 404);
        } elseif ($mascota->user_id != auth()->id()) {
            return response()->json('No tienes permisos para realizar esta acción', 403);
        } elseif ($mascota->user_id == auth()->id()) {
            $mascota->delete();
            return response()->json(['mensaje' => 'Eliminación realizada', 'id_mascota' => $mascota->id, 'implementador' => auth()->user()->name]);
        } else {
            return response()->json(['mensaje' => 'No se pudo realizar el cambio', 'id_mascota' => $mascota->id, 'implementador' => auth()->user()->name]);
        }
    }
}
