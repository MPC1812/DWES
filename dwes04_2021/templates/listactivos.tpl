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
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Empresa de mantenimiento</th>
            <th>Persona/contacto de mantenimiento</th>
            <th>Teléfono</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    <tbody>
        {foreach $activos as $activo}
        <tr>
            <td>
                {$activo->getId()}
            </td>
            <td>
                {$activo->getNombre()}
            </td>
            <td>
                {$activo->getDescripcion()}
            </td>
            <td>
                {$activo->getEmpresamnt()}
            </td>
            <td>
                {$activo->getContactomnt()}
            </td>
            <td>
                {$activo->getTelefonomnt()}
            </td>
            <td>
                <form action="borraractivo" method="post">
                    <input type='hidden' name='idactivo' value='{$activo->getId()}'>
                    <input type="submit" value="¡Borrar!">
                </form>
                <form action="editactivo" method="post">
                    <input type='hidden' name='idactivo' value='{$activo->getId()}'>
                    <input type="submit" value="Editar">
                </form>
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>
<a href='{$rootpath}'>Volver</a>