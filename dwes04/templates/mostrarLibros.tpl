<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Mostrar libros</title>
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
        background-color: #3e8e41;
        color: #ffffff;
        text-align: left;
    }

    table th,
    table td {
        padding: 12px 15px;
    }
</style>
<form action="/dwes04/index.php" method="post">
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
            </tr>
        {/foreach}
    </tbody>
    <button type="submit" name="ordenar" class="btn btn-dark btn-sm"
    value="true" >Ordenar por Fecha de Creación</button>
    <button type="submit" name="ordenar" class="btn btn-dark btn-sm"
    value="false" >Ordenar por Fecha de Actualización</button>
</table>
</form>
<a href='/dwes04/index.php'><button type="submit" name="home" class="btn btn-dark btn-sm">PÁGINA PRINCIPAL</button></a>
</html>