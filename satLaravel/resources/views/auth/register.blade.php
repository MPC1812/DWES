<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/estilos.css">
<title>Login Form</title>
</head>

<body>

<h2>Formulario de Registro</h2>
@if ($errors->any())
    <div class="error"> Al parecer hay algun error
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/register" method="post">
@csrf

  <div class="imgcontainer">
    <img src="img/avatar.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="name"><b>Username</b></label>
    <input type="text" id="name" placeholder="Nombre de usuario" name="name" value="{{ old('name') }}" autofocus required>

    <label for="email"><b>Email</b></label>
    <input type="text" id ="email" placeholder="Email" name="email" value="{{ old('email') }}" required>

    <label for="password"><b>Password</b></label>
    <input type="password" id="password" placeholder="Password, mínimo 8 caracteres" name="password" value="{{ old('password') }}" required>

    <label for="password_confirmation"><b>Confirmar Password</b></label>
    <input type="password" id="password_confirmation" placeholder="Confirmar Password" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
        
    <button type="submit">Login</button>
  </div>

</form>

</body>
</html>