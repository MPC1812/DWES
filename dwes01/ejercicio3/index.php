<!-- Mario Puerma Cortés -->
<?php
if (empty($_POST)) {
    $mensaje = 'Aún no se ha enviado nada!!!';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Formulario Selección</title>
</head>

<body>
    <p>A continuación te mostramos un formulario para seleccionar los productos con PVP mayor a un valor ingresado.</p>
    <p>Es obligatorio ingresar un valor numérico mayor a 0, por ejemplo 0.001 (nótese que para decimales se utiliza el punto), si no es válido,
    el filtrado finalizará avisando que debes ingresar un valor mayor a 0. La segunda comprobación que se hará es confirmar que se ha
    seleccionado al menos una familia, si no se ha seleccionado ninguna familia, el filtrado finalizará avisando que no se seleccionó.
    </p>
    <p><b><?= $mensaje ?? ''; ?></b></p>
    <h1>Formulario Selección</h1>
    <form action="datos.php" method="post">
        <label for="pvp">PVP mínimo:</label>
        <input type="text" name="pvp" id="pvp"><br>
        <input type="checkbox" name="smartphones" value="smartphones">Smartphones<br>
        <input type="checkbox" name="monitores" value="monitores">Monitores<br>
        <input type="checkbox" name="placasBase" value="placasBase">Placas Base<br>
        <input type="checkbox" name="fuentesAlimentacion" value="fuentesAlimentacion">Fuentes de Alimentación<br>
        <input type="submit" value="Enviar">
    </form>

</body>

</html>