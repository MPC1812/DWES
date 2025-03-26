<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/estilos.css">
<title>Login Form</title>
</head>

<body>
@if(Auth::check())
@include('plantillas.navbar')
<h2>Bienvenido {{ Auth::user()->name}}</h2>
<a href="{{ route('dashboard') }}"></a>
@else
<h2 class="verde">Bienvenido</h2>
  <div class="imgcontainer">
    <img src="img/avatar.png" alt="Logo Empresa" class="avatar">
  </div>

<form action="/" method="post">
@csrf

  <div class="container">
    <label for="name"><b>Username</b></label>
    <input type="text" id="name" placeholder="Nombre de usuario" name="name" value="{{ old('name') }}" autofocus required>

    <label for="password"><b>Password</b></label>
    <input type="password" id="password" placeholder="Password" name="password" value="{{ old('password') }}" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" id="remember" name="remember"> Recuérdame
    </label>
  </div>

  {{-- <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="registerbtn">Registrar</button>
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div> --}}
</form>
@endif
@include('plantillas.footer')
</body>
</html>