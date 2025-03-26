<?php
namespace App\Http\Controllers\ApiMPC;

use App\Http\Controllers\Controller;
//Clases que necesitamos para que funcione el controlador 
use App\Models\MascotaMPC;
use Illuminate\Support\Facades\Auth;


class MPCMascotasControllerAPI extends Controller
{
    public function listarMascotasMPC(){
        $mascotas = MascotaMPC::where('user_id', Auth::user()->id)->get(); //Obtener el listado de mascotas del usuario
        $arraycount=count($mascotas);
        $i=0;
        while($i<$arraycount){
            $newmascotas[$i]['id'] = $mascotas[$i]['id'];
            $newmascotas[$i]['nombre'] = $mascotas[$i]['nombre'];
            $newmascotas[$i]['descripcion'] = $mascotas[$i]['descripcion'];
            $newmascotas[$i]['tipo'] = $mascotas[$i]['tipo'];
            $newmascotas[$i]['megustas'] = $mascotas[$i]['megusta'];
            $i++;
        }
        return response()->json($newmascotas);
    }
}
