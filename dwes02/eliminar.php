<!-- Mario Puerma Cortés -->
<?php
require_once __DIR__ . '/funciones/conectarBD.php';
require_once __DIR__ . '/funciones/listarProductos.php';
require_once __DIR__ . '/funciones/eliminarProducto.php';

$conexion = conectarBD(); //conexión a la base de datos
$datos = listarProductos($conexion);

//Condiciones que debe cumplirse para que el usuario pueda eliminar un producto
if (isset($_POST['eliminar']) && is_numeric($_POST['id'])) {
    eliminarProducto($conexion, $_POST['id']);
    echo 'Producto eliminado.';
}
if (isset($_POST['eliminar']) && ($_POST['id'] === "" || !is_numeric($_POST['id'])))
    echo 'No se ha introducido ninguna id válido.';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eliminar productos</title>
</head>

<body>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Código EAN</th>
            <th>Categoría</th>
            <th>Propiedades</th>
            <th>Unidades</th>
            <th>Precio</th>
            <th></th>
            <th></th>
            <th>Operaciones</th>
        </tr>
        <?php
        foreach ($datos as $dato): ?>
            <tr>
                <form action="eliminar.php" method="post">
                    <td><?= $dato['nombre']; ?></td>
                    <td><?= $dato['codigo_ean']; ?></td>
                    <td><?= $dato['categoria']; ?></td>
                    <td><?= $dato['propiedades'] ?? 'No descritas'; ?></td>
                    <td><?= $dato['unidades']; ?></td>
                    <td><?= $dato['precio']; ?></td>
                    <td><input type="hidden" name="id" value="<?= $dato['id']; ?>"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>