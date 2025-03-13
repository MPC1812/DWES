DWES05
Iniciamos el proyecto
	composer create-project laravel/laravel:~10 dwes05

modificamos el archivo .env
	DB_CONNECTION=mysql
	DB_HOST=localhost
	DB_PORT=3306
	DB_DATABASE=2425_dwes05
	DB_USERNAME=root
	DB_PASSWORD=

Creamos migración para crear la tabla "mascotas" con el código que se da a continuación
	php artisan make:migration crear_tabla_mascota_virtual_MPC
		return new class extends Migration
		{
			public function up(): void
			{
				Schema::create('mascotas', function (Blueprint $table) {
					$table->id();
					// Cada mascota pertenece a un usuario, si se borra el usuario o se actualiza su id, se actualiza en cascada
					$table->unsignedBigInteger('user_id');
					$table->foreign('user_id')->references('id')
						->on('users')->cascadeOnDelete()->cascadeOnUpdate();
			
					$table->timestamps();
				});
			}

			public function down(): void
			{
				Schema::dropIfExists('mascotas');
			}
		};

Ejecutamos las migraciones, se nos preguntará en el caso de no existir la BD "2425_dwes05" si queremos crearla, le decimos "yes"
	php artisan migrate
	
Creamos una nueva migración para modificar la tabla "mascotas" con los siguientes datos
	php artisan make:migration alter_tabla_mascota_virtual_MPC 
		<?php

		use Illuminate\Database\Migrations\Migration;
		use Illuminate\Database\Schema\Blueprint;
		use Illuminate\Support\Facades\Schema;

		return new class extends Migration
		{
			/**
			 * Run the migrations.
			 */
			public function up(): void
			{
				//Datos añadidos por nosotros
				Schema::table('mascotas', function (Blueprint $table) {
					$table->string('nombre',50);
					$table->string('descripcion',250);
					$table->enum('tipo',['Perro', 'Gato', 'Pájaro','Dragón','Conejo','Hamster','Tortuga','Pez','Serpiente']);
					$table->enum('publica',['Si','No']);
					$table->bigInteger('megusta')->default(0);
				});
			}

			/**
			 * Reverse the migrations.
			 */
			public function down(): void
			{
				//
			}
		};
Creamos el modelo MascotaMPC con el código que se da a continuación
	php artisan make:model MascotaMPC
		<?php

		namespace App\Models;

		use Illuminate\Database\Eloquent\Factories\HasFactory;
		use Illuminate\Database\Eloquent\Model;

		class MascotaMPC extends Model
		{
			use HasFactory;

			protected $table = 'mascotas';

			protected $fillable = [
				'nombre',
				'descripcion',
				'tipo',
				'publica',
				'megusta',
				'user_id',
			];

			public function user(){
				return $this->belongsTo(User::class);
			}
		}
Modificamos el modelo App\Models\User para establecer la relación con MascotaMPC
    public function mascotas()
    {
        return $this->hasMany(MascotaMPC::class);
    }

Probamos el modelo
	php artisan tinker

	use App\Models\User;
	$user1 = User::create(['name' => 'user1', 'email' => 'user1@userland.dwes', 'password' => 'user1']);

Si todo ha ido bien, deberíamos ver en la terminal que ha creado al usuario "user1" con el id 1. Vamos a probarlo.

	$user1 = User::find(1);
	//Obtenemos el usuario con el id 1
	$user1->email_verified_at = now();
	//Modificamos el email_verified_at a la fecha actual
	$user1->save();
	//Guardamos los cambios

Ahora vamos a crear una nueva mascota
	use App\Models\MascotaMPC;
	$mascota1 = MascotaMPC::create(['nombre' => 'mascota MPC', 'descripcion' => 'Es un perrito', 'tipo' => 'Perro', 'publica' => 'Si', 'user_id' => 1]);
	//Creamos una nueva mascota
    $mascota1->save();
    //Guardamos los cambios

Creacion de seeder
    php artisan make:seeder MPCSeeder

	Rellenamos con 2 usuarios y 4 mascotas, con el siguiente código

		public function run(): void
		{
			if (User::where('name', 'MPC1')->count() == 0) {
				$userMPC1 = User::create([
					'name' => 'MPC1',
					'email' => 'MPC1@email.MPC',
					'password' => Hash::make('MPC1'),
					'email_verified_at' => now(),
				]);
			}
			if (User::where('name', 'MPC2')->count() == 0) {
				$userMPC2 = User::create([
					'name' => 'MPC2',
					'email' => 'MPC2@email.MPC',
					'password' => Hash::make('MPC2'),
					'email_verified_at' => now(),
				]);
			}
			if (MascotaMPC::where('nombre', 'mascota MPC01')->count() == 0) {
				$mascota1 = MascotaMPC::create([
					'nombre' => 'mascota MPC01',
					'descripcion' => 'Es un perrito',
					'tipo' => 'Perro',
					'publica' => 'Si',
					'user_id' => $userMPC1->id,
				]);
			}
			if (MascotaMPC::where('nombre', 'mascota MPC02')->count() == 0) {
				$mascota2 = MascotaMPC::create([
					'nombre' => 'mascota MPC02',
					'descripcion' => 'Es un gato',
					'tipo' => 'Gato',
					'publica' => 'Si',
					'user_id' => $userMPC2->id,
				]);
			}
			if (MascotaMPC::where('nombre', 'mascota MPC03')->count() == 0) {
				$mascota3 = MascotaMPC::create([
					'nombre' => 'mascota MPC03',
					'descripcion' => 'Es un conejo',
					'tipo' => 'Serpiente',
					'publica' => 'No',
					'user_id' => $userMPC1->id,
				]);
			}
			if (MascotaMPC::where('nombre', 'mascota MPC04')->count() == 0) {
				$mascota4 = MascotaMPC::create([
					'nombre' => 'mascota MPC04',
					'descripcion' => 'Es un hamster',
					'tipo' => 'Hamster',
					'publica' => 'No',
					'user_id' => $userMPC2->id,
				]);
			}
		}

Ejecutamos el seeder
	php artisan db:seed MPCSeeder

Crear el controlador de autenticación con ubicación App\Http\Controllers\Auth\LoginController.php
	php artisan make:controller Auth/LoginController

Modificar el archivo App\Http\Controllers\Auth\LoginController.php con el siguiente código
	<?php

	namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;

	class LoginController extends Controller
	{
		// Mostrar el formulario de inicio de sesión autenticada
		public function mostrarFormularioLoginMPC()
		{
			return view('auth.login');
		}

		// Realizar el inicio de sesión autenticada
		public function loginMPC(Request $request)
		{
			// Validar los datos del formulario
			$credentials = $request->validate([
				'email' => 'required|email',
				'password' => 'required',
			]);

			// Se verifica email/password (true si ok)
			if (Auth::attempt($credentials)) {
				//Si ok--> se regenera sesión (se anota que está autenticado en la sesión).
				$request->session()->regenerate();
				//Redireccionamos a la página principal de la zona autenticada
				return redirect()->intended(route('zonaprivada'));
			}

			// Si la autenticación falla, volver al formulario con un error
			return back()->withErrors([
				'email' => 'El email o la contraseña no son válidos.',
			])->onlyInput('email');
		}

		// Cerrar sesión autenticada
		public function logoutMPC(Request $request)
		{
			Auth::logout();

			$request->session()->invalidate();
			$request->session()->regenerateToken();

			return redirect(route('zonapublica'));
		}
	}
Ahora modificamos el archivo routes\web.php para que use nuestro controlador de autenticación
	<?php

	use Illuminate\Support\Facades\Route;
	use App\Http\Controllers\Auth\LoginController;

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

Ahora creamos las tres vistas (plantillas Blade)
resources\views\auth\login.blade.php
	<!DOCTYPE html>
	<html>

	<head>
		<title>Inicio de Sesión</title>
	</head>

	<body>
		@auth

			<h1>Ya has iniciado sesión</h1>
			<a href="{{ route('zonaprivada') }}">Ir a zona privada</a>

		@endauth

		@guest
			<h1>Iniciar Sesión</h1>
			@if ($errors->any())
				<div style="color: red;">
					<H2>ERRORES:</H2>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<!-- Formulario de inicio de sesión -->
			<form method="POST" action="{{ route('login') }}">
				@csrf
				<label for="email">Correo Electrónico:</label>
				<input type="email" id="email" name="email" value="{{ old('email') }}"><BR>
				<label for="password">Contraseña:</label>
				<input type="password" id="password" name="password"><BR>
				<input type="submit" value="Login">
			</form>
		@endguest


	</body>

	</html>

resources/views/principal.blade.php
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=100%, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Página principal</title>
	</head>
	<body>
		<H2>Bienvenido a la página principal PÚBLICA.</H2>
		@auth
			Estás autenticado, puedes ir a ...
			<A href="{{ route('zonaprivada') }}">tu zona privada</A><BR>
		@endauth
		@guest
			No estás autenticado, por favor ...
			<A href="{{ route('formlogin') }}">inicia sesión.</A><BR>
		@endguest

	</body>
	</html>

resources/views/privada/principal.blade.php
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=100%, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>ZONA PRIVADA</title>
	</head>
	<body>
		@auth
		<H2>Bienvenido {{ Auth::user()->name}} a la página principal de la zona PRIVADA.</H2>
			<A href="{{ route('zonapublica') }}">Ve a la zona pública</A><BR>
			<A href="{{ route('logout') }}">Cierra sesión.</A></BR>
		@endauth

	</body>
	</html>

Modificamos el archivo routes\web.php para que use nuestro controlador de autenticación
	//Ruta a la zona pública (simplemente accediendo a / vía GET)
	Route::get('/', function () {
		$mascotas = MascotaMPC::all(); //Obtener el listado de mascotas
		return view('principal', ['mascotasMPC'=>$mascotas]);
	})->name('zonapublica');
	//Ruta a la zona privada (simplemente accediendo a /zonaprivada vía GET)
	Route::get('/zonaprivada', function () {
		$mascotas = MascotaMPC::where('user_id', Auth::user()->id)->get(); //Obtener el listado de mascotas del usuario
		return view('privada.principal',['mascotasMPC' => $mascotas]);
	})->middleware('auth')->name('zonaprivada');

Ahora modificamos las vistas principal.blade.php 
	<table>
        <thead>
            <tr>
                <th>Id</th><th>Nombre</th><th>Descripcion</th><th>Tipo</th><th>Publica</th><th>#Me gustas</th><th>Propietario</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($mascotasMPC as $mascota)
            <tr>
                <td>{{$mascota->id}}</td>
                <td>{{$mascota->nombre}}</td>
                <td>{{$mascota->descripcion}}</td>
                <td>{{$mascota->tipo}}</td>
                <td>{{$mascota->publica}}</td>
                <td>{{$mascota->megusta}}</td>
                <td>{{$mascota->user->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

y privada/principal.blade.php para mostrar los datos de las mascotas
	    <table>
        <thead>
            <tr>
                <th>Id</th><th>Nombre</th><th>Descripcion</th><th>Tipo</th><th>Publica</th><th>#Me gustas</th><th>Propietario</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($mascotasMPC as $mascota)
            <tr>
                <td>{{$mascota->id}}</td>
                <td>{{$mascota->nombre}}</td>
                <td>{{$mascota->descripcion}}</td>
                <td>{{$mascota->tipo}}</td>
                <td>{{$mascota->publica}}</td>
                <td>{{$mascota->megusta}}</td>
                <td>{{$mascota->user->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

Ahora vamos a crear un controlador para crear mascotas
	php artisan make:controller MascotaControllerMPC

Creamos la plantilla blade que mostrará el formulario para crear mascotas
	resources/views/privada/formmascotaMPC.blade.php
		<!DOCTYPE html>
		<html lang="es">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=100%, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<title>Formulario de creación de mascotas</title>
		</head>
		<body>
			<h1>Formulario de creación de mascotas</h1>
			@if ($errors->any())
				<H3>Se han producido errores en el formulario:</H3>
				<UL>
					@foreach ($errors->all() as $error)
						<LI>{{ $error }}</LI>
					@endforeach
				</UL>
			@endif
			<!-- Formulario de creación de mascotas -->
			<form method="POST" action="{{ route('nuevamascotaMPC') }}">
				@csrf
				<label for="nombre">Nombre:</label>
				<input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"><BR>
				<label for="descripcion">Descripción:</label>
				<input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}"><BR>
				<label for="tipo">Tipo:</label>
				<select name="tipo" id="tipo">
					<option value="Perro">Perro</option>
					<option value="Gato">Gato</option>
					<option value="Pájaro">Pájaro</option>
					<option value="Dragón">Dragón</option>
					<option value="Conejo">Conejo</option>
					<option value="Hamster">Hamster</option>
					<option value="Tortuga">Tortuga</option>
					<option value="Pez">Pez</option>
					<option value="Serpiente">Serpiente</option>
				</select><BR>
				<label for="publica">Publica:</label>
				<select name="publica" id="publica">
					<option value="Si">Si</option>
					<option value="No">No</option>
				</select><BR>
				<input type="submit" value="Crear">
			</form>
		</body>
		</html>

Modificamos el archivo App\Http\Controllers\MascotaControllerMPC.php con el siguiente código
	<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Models\MascotaMPC;
	use App\Models\User;

	class MascotaControllerMPC extends Controller
	{
		// Mostrar formulario de creación de mascotas
		public function mostrarFormularioCrearMascotaMPC()
		{
			return view('privada.formmascotaMPC');
		}
		// Crear mascota
		public function nuevamascotaMPC(Request $request)
		{
			$nombre = $request->nombre;
			$descripcion = $request->descripcion;
			$tipo = $request->tipo;
			$publica = $request->publica;
			$user_id = Auth::user()->id;
			$mascota = new MascotaMPC;
			$mascota->nombre = $nombre;
			$mascota->descripcion = $descripcion;
			$mascota->tipo = $tipo;
			$mascota->publica = $publica;
			$mascota->user_id = $user_id;
			$mascota->save();
			return redirect()->route('zonaprivada');
		}
	}

Creamos la ruta en el archivo routes\web.php para que use nuestro controlador de autenticación
	//Ruta para mostrar el formulario de creación de mascotas
	Route::get('/crearMascotaMPC', [MascotaControllerMPC::class, 'mostrarFormularioCrearMascotaMPC'])->name('mostrarFormularioCrearMascotaMPC');
	
