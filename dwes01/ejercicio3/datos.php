<!-- Mario Puerma Cortés -->
<?php

$array = [];
$seleccionArray = [];
$array[0] = array("nombre" => "Iphone 15", "PVD" => 847.42, "PVP" => 877.42, "codigo" => "APP4680", "familia" => "smartphones");
$array[1] = array("nombre" => "TCL 40SE", "PVD" => 115, "PVP" => 129.90, "codigo" => "TCL101", "familia" => "smartphones");
$array[2] = array("nombre" => "ASUS ROG SWIFT OLED PG49WCD", "PVD" => 1309.55, "PVP" => 1509.55, "codigo" => "PG49WCD", "familia" => "monitores");
$array[3] = array("nombre" => "ROG MAXIMUS Z790 APEX ENCORE", "PVD" => 780, "PVP" => 828.18, "codigo" => "ASK2857", "familia" => "placasBase");
$array[4] = array("nombre" => "UNYKA SFX 450W", "PVD" => 12, "PVP" => 16.53, "codigo" => "UNY67", "familia" => "fuentesAlimentacion");
$array[5] = array("nombre" => "OPPO A60", "PVD" => 149, "PVP" => 179, "codigo" => "OPP195", "familia" => "smartphones");
$array[6] = array("nombre" => "MSI PRO MP243X", "PVD" => 66.15, "PVP" => 89, "codigo" => "MSI3808", "familia" => "monitores");
$array[7] = array("nombre" => "TUF Gaming VG28UQL1A", "PVD" => 601.25, "PVP" => 667.50, "codigo" => "ASK1170", "familia" => "monitores");
$array[8] = array("nombre" => "PRO H610M-E", "PVD" => 65.85, "PVP" => 74.92, "codigo" => "MSI3503", "familia" => "placasBase");
$array[9] = array("nombre" => "MPG AI1300P", "PVD" => 328.99, "PVP" => 358.99, "codigo" => "MSI3621", "familia" => "fuentesAlimentacion");

if (isset($_POST['pvp'])) {
    //vamos a sanear los datos introducidos ya que estamos tratando con datos de tipo texto
    $valor = $_POST['pvp'];
    //Espacios antes y después
    $valor = trim($valor);
    //Quitar etiquetas HTML
    $valor = strip_tags($valor);
    //Convertir a entidades HTML
    $valor = htmlspecialchars($valor);
    if (strlen($valor) > 0 && floatval($valor) > 0) {
        
        if (isset($_POST['smartphones'])) {
            $seleccionArray[] = 'smartphones';
        }
        if (isset($_POST['monitores'])) {
            $seleccionArray[] = 'monitores';
        }
        if (isset($_POST['placasBase'])) {
            $seleccionArray[] = 'placasBase';
        }
        if (isset($_POST['fuentesAlimentacion'])) {
            $seleccionArray[] = 'fuentesAlimentacion';
        }
        if ($seleccionArray == []) {
            die('Debes seleccionar al menos una familia, programa terminando');
        }
    } else if (strlen($valor) == 0) {
        die('No ha introducido ningún valor en PVP mínimo o PVP mínimo es una cadena vacía, programa terminando');
    } else {
        die('Debes introducir un valor válido en el campo PVP mínimo, programa terminado');
    }}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>DWES Tarea01 Sección 3</title>
    <style>
        table,
        th,
        td {
            border-collapse: collapse;
            border: 1px solid black;
            text-align: center;
        }

        th,
        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <p><?= $mensaje ?? ''; ?></p>
    <h1>Datos de productos con PVP mayor a <?= $valor; ?></h1>
    <table>
        <tr>
            <?php echo "<table border='1'>";
            echo "<tr><th>Nombre</th><th>PVD</th><th>PVP</th><th>Codigo</th><th>Familia</th></tr>"; ?>
        </tr>
        <?php foreach ($array as $fila): ?>
            <?php for ($i = 0; $i < count($seleccionArray); $i++) {
                if ($fila['PVP'] > floatval($valor) && $fila['familia'] == $seleccionArray[$i]): ?>
                    <tr>
                        <td><?= $fila['nombre']; ?></td>
                        <td><?= $fila['PVD']; ?></td>
                        <td><?= $fila['PVP']; ?></td>
                        <td><?= $fila['codigo']; ?></td>
                        <td><?= $fila['familia']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php } ?>
        <?php endforeach; ?>
    </table>
</body>

</html>