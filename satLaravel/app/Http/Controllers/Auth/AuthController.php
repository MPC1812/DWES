<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store (Request $request)
    {
        // Validar los datos del formulario
			$credentials = $request->validate([
				'name' => 'required',
				'password' => 'required',
			]);

			// Se verifica nombre/password (true si ok)
			if (Auth::attempt($credentials)) {
				//Si ok--> se regenera sesión (se anota que está autenticado en la sesión).
				$request->session()->regenerate();
				//Redireccionamos a la página principal de la zona autenticada
				return redirect()->intended(route('dashboard'));
			}

			// Si la autenticación falla, volver al formulario con un error
			return back()->withErrors([
				'name' => 'El username o password son incorrectos',
			])->onlyInput('name');
    }

    public function guardarNuevoUsuario(Request $request)
    {
        /* 
        Validation
        */
        $validarRequest = [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
        $mensajesRequest = [
            'name.required' => 'El username es obligatorio',
            'name.unique' => 'El username ya existe',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El password es obligatorio',
            'password.confirmed' => 'El password y la confirmacion no coinciden',
            'password.min' => 'La password debe tener al menos 8 caracteres',
        ];
        
        $request->validate($validarRequest, $mensajesRequest);

        /*
        Database Insert
        */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $mensaje = "Usuario dado de alta correctamente";
        return view('plantillas.avisos')->with('mensaje', $mensaje);
        
        // return redirect()->intended(route('mensaje'))->with('mensaje', $mensaje);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function index(Request $request)
    {
        return view('dashboard');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
        'name' => 'required',
        ]);
        $status = Password::sendResetLink($request->only('name'));
        return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withInput($request->only('name'))->withErrors([
            'name' => __($status),
            ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'name' => 'required',
            'password' => 'required|confirmed|min:8',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation',  function ($user) use ($request) {
                $user->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60)
                ])->save();
                }
                ));
                return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withInput($request->only('name'))->withErrors(['name' => __($status)]);
               }
}
