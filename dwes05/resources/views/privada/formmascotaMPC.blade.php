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
        <form method="post" action="{{ route('nuevamascotaMPC') }}">
        @csrf
        <label for="nombre">Nombre de la mascota:</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"><BR>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" rows="8" cols="32">{{ old('descripcion') }}</textarea><BR>
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
        <label for="publica">¿Pública?:</label>
        <input type = "radio" name="publica" value="Si">Si
        <input type = "radio" name="publica" value="No">No<br>
        <br><input type="submit" value="Crear!">
    </form>
</body>

</html>