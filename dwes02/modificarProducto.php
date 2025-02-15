<!-- Mario Puerma Cortés -->
<?php
require_once __DIR__ . '/funciones/conectarBD.php';
require_once __DIR__ . '/funciones/listarProductos.php';
require_once __DIR__ . '/funciones/actualizarProducto.php';

$conexion = conectarBD(); //conexión a la base de datos
$datos = listarProductos($conexion);

//Condiciones que deben cumplirse para que se puedan modificar los datos
if (isset($_POST['modificar']) && is_numeric($_POST['unidades'])) {
    $nuevasUnidades = $_POST['original'] + $_POST['unidades'];
    // actualizarProducto($conexion, $_POST['id'], $nuevasUnidades);
    actualizarProducto($conexion, $_POST['id'], $_POST['unidades']);
    if ($nuevasUnidades > 0) {
        echo 'Incremento o decremento de unidades realizado.';
    }
}
if (isset($_POST['modificar']) && ($_POST['unidades'] === "" || !is_numeric($_POST['unidades'])))
    echo 'No se ha introducido ninguna unidad o no es válida.';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modificar productos</title>
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
                <form action="modificarProducto.php" method="post">
                    <td><?= $dato['nombre']; ?></td>
                    <td><?= $dato['codigo_ean']; ?></td>
                    <td><?= $dato['categoria']; ?></td>
                    <td><?= $dato['propiedades'] ?? 'No descritas'; ?></td>
                    <td><?= $dato['unidades']; ?></td>
                    <td><?= $dato['precio']; ?></td>
                    <td><input type="hidden" name="id" value="<?= $dato['id']; ?>"></td>
                    <td><input type="hidden" name="original" value="<?= $dato['unidades']; ?>"></td>
                    <td><input type="text" name="unidades"></td>
                    <td><input type="submit" name="modificar" value="Modificar"></td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>