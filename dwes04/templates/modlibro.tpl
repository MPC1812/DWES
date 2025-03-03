<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Añadir/Modificar libro</title>
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
    form {
    margin-top: 1em;
    }
</style>
<form action="/dwes04/addlibro" method="post">
<input type="text" name="id" placeholder="ID Sólo para modificar">	
<input type="text" name="isbn" placeholder="ISBN" required>
<input type="text" name="titulo" placeholder="Título" required>
<input type="text" name="autor" placeholder="Autor" required>
<input type="text" name="anio" placeholder="Año de publicación" required>
<input type="text" name="paginas" placeholder="Número de páginas" required>
<input type="text" name="ejemplares" placeholder="Ejemplares disponibles" required>
<button type="submit" name="addlibro" class="btn btn-dark btn-sm">AÑADIR/MODIFICAR</button>
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
            </tr>
        {/foreach}
    </tbody>
</table>
</html>