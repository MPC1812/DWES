<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página principal</title>
</head>
<body>
@extends('plantillas.plantpublica')

@section('titulo', 'Inicio')

@section('contenido')
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
@endsection
</body>
</html>