<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Form;

class ClienteController extends Controller
{
    public function validarUsuario(request $request)
    {
        if (Validator::make($request->all(), [
            'telefono' => ['required', 'integer', 'exists:clientes,telefono'],
        ])) {

            $cliente = DB::table('clientes')->where('telefono', $request->telefono)->first();
            return view('partes.nuevoequipo', ['cliente' => $cliente]);
        } else{
            $cliente = $request->validate([
                'telefono' => 'required',
                'nombre' => 'string|min:3',
                'email' => 'required|email',    
            ]);

            return view('partes.nuevoequipo', ['cliente' => $cliente]);
        }
    }

    public function validarEquipo(request $request)
    {
        $credentials = $request->validate([
            'telefono' => 'required',
            'nombre'=> 'string|min:3',
            'email' => 'email',
        ]);
        if (Validator::make($request->all(), [
            'telefono' => ['required', 'integer', 'exists:clientes,telefono'],
        ])) {

            $cliente = DB::table('clientes')->where('telefono', $request->telefono)->first();
            view('partes.nuevoequipo')->with('cliente', $cliente);
        }

        view('partes.nuevoequipo')->with('cliente', $credentials);
    }
}
