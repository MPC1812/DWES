<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Añadir libro</title>
</head>
<style>
    table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }

    table th,
    table td {
        padding: 12px 15px;
    }
</style>
<form action="/addlibro" method="post">
<input type="number" name="isbn" placeholder="ISBN">
<input type="text" name="titulo" placeholder="Título">
<input type="text" name="autor" placeholder="Autor">
<input type="number" name="anio" placeholder="Año de publicación">
<input type="number" name="paginas" placeholder="Número de páginas">
<input type="number" name="ejemplares" placeholder="Ejemplares disponibles">
<button type="submit" name="addlibro" class="btn btn-dark btn-sm">AÑADIR</button>
</form>
<table border="1px solid blue">
    <thead>
        <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Año de publicación</th>
            <th>Número de páginas</th>
            <th>Ejemplares disponibles</th>
            <th>Fecha de creación</th>
            <th>Fecha de actualización</th>
        </tr>
    </thead>
    <tbody>
        {foreach $listadolibros as $libro}
            <tr>
                <td>{$libro->getId()}</td>
                <td>{$libro->getIsbn()}</td>
                <td>{$libro->getTitulo()}</td>
                <td>{$libro->getAutor()}</td>
                <td>{$libro->getAnioPublicacion()}</td>
                <td>{$libro->getPaginas()}</td>
                <td>{$libro->getEjemplaresDisponibles()}</td>
                <td>{$libro->getFechaCreacion()}</td>
                <td>{$libro->getFechaActualizacion()}</td>
                <td><button type="submit" name="modificar" class="btn btn-dark btn-sm">MODIFICAR</button></td>
            </tr>
        {/foreach}
    </tbody>
</table>
<a href='/index.php'><button type="submit" name="home" class="btn btn-dark btn-sm" method="post">PÁGINA PRINCIPAL</button></a>