<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZONA PRIVADA</title>
</head>

<body>
@extends('plantillas.plantprivada')

@section('titulo', 'Inicio')

@section('contenido')
<h4>Mis mascotas</h4>
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
                    <th></th>
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
    @endsection
</body>

</html>