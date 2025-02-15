<!-- Mario Puerma Cortés -->
<?php
require_once __DIR__ . '/funciones/conectarBD.php';
require_once __DIR__ . '/funciones/listarProductos.php';

$conexion = conectarBD(); //conexión a la base de datos
if (isset($_POST['categoria'])) $_POST['categoria']=htmlspecialchars($_POST['categoria']);
else $_POST['categoria']='';
$datos=listarProductos($conexion,$_POST['categoria']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
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
        </tr>
        <?php
        foreach ($datos as $dato): ?>
            <tr>
                <td><?= $dato['nombre']; ?></td>
                <td><?= $dato['codigo_ean']; ?></td>
                <td><?= $dato['categoria']; ?></td>
                <td><?= $dato['propiedades']?? 'No descritas'; ?></td>
                <td><?= $dato['unidades']; ?></td>
                <td><?= $dato['precio']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <form action="" method="post">
        Categoria: <SELECT name="categoria">
            <?php foreach (CATEGORIAS as $categoria): ?>
                <option value="<?= htmlentities($categoria); ?>"><?= htmlspecialchars($categoria); ?></option>
            <?php endforeach; ?>
        <input type="submit" value="Enviar!">
    </form>
</body>

</html>