<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="css/navbar.css">
<title>@yield('titulo')</title>
</head>

<body>
<ul class="d-flex flex-column flex-md-row">
  @if(Auth::check())
  <spam class="d-flex flex-row me-auto">
  <li><a class="active" href="/dashboard">Dashboard</a></li>
  <li><a href="/nuevoparte">Nuevo Parte</a></li>
  <li><a href="/editarparte">Editar Parte</a></li>
  <li><a href="/eliminarparte">Eliminar Parte</a></li>
  <li><a href="/mostrarparte">Mostrar Parte</a></li>
  </spam>
  <spam class="d-flex flex-row-reverse">
  <li><a href="/logout">Cerrar Sesión</a></li>
  </spam>
  @else
  @endif
</ul>
</body>
</html>