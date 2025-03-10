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
        <a href="{{ route('zonaprivada') }}">Tu zona privada</a>
        @endauth
        @guest
        <h3>Bienvenido Usuario</h3>
        <a href="{{ route('formlogin') }}">Iniciar sesión</a>
        @endguest
        <a href="/" class="main-page">Página Principal</a>
    </div>
    <H2>Bienvenido a la página principal PÚBLICA.</H2>
    @auth
    Estás autenticado, puedes ir a ...
    <a href="{{ route('zonaprivada') }}">tu zona privada</a><br>
    @endauth
    @guest
    No estás autenticado, por favor ...
    <a href="{{ route('formlogin') }}">inicia sesión.</a><br>
    @endguest

    <br>@yield('contenido')

    <footer>
        <br><p>Creado por Mario Puerma Cortés</p>
        <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank">
            <img src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" alt="Licencia Creative Commons"></a>
    </footer>

</body>

</html>