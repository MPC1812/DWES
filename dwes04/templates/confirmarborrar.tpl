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
        background-color: #3e8e41;
        color: #ffffff;
        text-align: left;
    }

    table th,
    table td {
        padding: 12px 15px;
    }
</style>
<form action="/dwes04/index.php?accion=borrar_libro_MPC" method="post">
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
                    <td>
                        <input type="checkbox" name="checkboxborrar" value="checkboxborrar">
                        <button type="submit" name="id" class="btn btn-dark btn-sm"
                            value="{$libro->getId()}" >BORRAR</button>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</form>
</html>