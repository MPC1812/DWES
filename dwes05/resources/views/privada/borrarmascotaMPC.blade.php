<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultado de la creación de mascota</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
@extends('plantillas.plantprivada')

@section('titulo', 'Inicio')

@section('contenido')
    <h1>Resultado de la creación de mascota</h1>
    <p>Se ha borrado la mascota con id {{$id}} by Mario Puerma Cortés</p>
@endsection
</body>
</html>