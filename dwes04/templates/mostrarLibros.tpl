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
<a href='/index.php'><button type="submit" name="home" class="btn btn-dark btn-sm">PÁGINA PRINCIPAL</button></a>