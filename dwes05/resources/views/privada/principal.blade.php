<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZONA PRIVADA</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
        }

        h3 {
            text-align: left;
            text-decoration: green wavy underline;
            color: blue;
        }
    </style>
</head>

<body>
    @auth
    <h2>Bienvenido {{ Auth::user()->name}} a la página principal de la zona PRIVADA.</h2>
    <a href="{{ route('zonapublica') }}">Ve a la zona pública</a><br>
    <a href="{{ route('logout') }}">Cierra sesión.</a><br>
    <h3>Mis mascotas</h3>
    <a href="{{ route('formmascotaMPC') }}">Crear nueva mascota</a><br><br>
    @endauth
    @if ($errors->any())
    <H3>Se han producido errores en el formulario:</H3>
    <UL>
        @foreach ($errors->all() as $error)
        <LI>{{ $error }}</LI>
        @endforeach
    </UL>
    @endif
    <form method="post" action="{{ route('borrarmascotaMPC') }}">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Tipo</th>
                    <th>Publica</th>
                    <th>#Me gustas</th>
                    <th>Propietario</th>
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
                    <td>
                        <input type="hidden" value="{{$a=$mascota->id}}">
                        <button type="submit" name="id" class="btn btn-dark btn-sm" value="{{$a}}">Borrar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</body>

</html>