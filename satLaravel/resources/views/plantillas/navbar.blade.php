<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/navbar.css">
<title>@yield('titulo')</title>
</head>

<body>
<ul>
  @if(Auth::check())
  <li><a class="active" href="/dashboard">Dashboard</a></li>
  <li><a href="/registroEntrada">Registro de Entrada</a></li>
  <li><a href="/logout">Cerrar Sesión</a></li>
  @else
  @endif
  <li><a href="/about">Conoce Laravel</a></li>
</ul>
</body>
</html>