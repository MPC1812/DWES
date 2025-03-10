<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="utf-8" />
    <title>@yield('titulo') - Nombre de la empresa</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}" />
</head>

<body>
    <div class="navbar">
        @auth
        <h3>Bienvenido {{ Auth::user()->name}}</h3>
        <a href="{{ route('zonapublica') }}">Zona pública</a>
        <a href="{{ route('logout') }}">Cierra sesión</a>
        <a href="{{ route('formmascotaMPC') }}">Crear nueva mascota</a>
        @endauth
        <a href="/" class="main-page">Página Principal</a>
    </div>

    @auth
    <h2>Bienvenido {{ Auth::user()->name}} a la página principal de la zona PRIVADA.</h2>
    <a href="{{ route('zonapublica') }}">Ve a la zona pública</a><br>
    <a href="{{ route('logout') }}">Cierra sesión.</a><br>
    <a href="{{ route('formmascotaMPC') }}">Crear nueva mascota</a><br>
    @endauth
    @if ($errors->any())
    <H3>Se han producido errores en el formulario:</H3>
    <UL>
        @foreach ($errors->all() as $error)
        <LI>{{ $error }}</LI>
        @endforeach
    </UL>
    @endif

    <br>@yield('contenido')

    <footer>
        <br><p>Creado por Mario Puerma Cortés</p>
        <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank">
            <img src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" alt="Licencia Creative Commons"></a>
    </footer>

</body>

</html>