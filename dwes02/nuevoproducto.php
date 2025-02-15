<!-- Mario Puerma Cortés -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
</head>

<body>

    <form action="guardarProducto.php" method="post">
        <!-- Nombre: <input type="text" name="nombre" minlength="1" maxlength="30" required><br />
        Código EAN: <input type="text" name="codigo_ean" minlength="8" maxlength="13" required><br /> -->
        Nombre: <input type="text" name="nombre" ><br />
        Código EAN: <input type="text" name="codigo_ean" ><br />
        Categoria: <select name="categoria">
            <option value="lacteos">Lacteos</option>
            <option value="conservas">Conservas</option>
            <option value="bebidas">Bebidas</option>
            <option value="snacks">Snacks</option>
            <option value="dulces">Dulces</option>
            <option value="otros">Otros</option>
            <option value="prueba">Prueba</option>
        </select><br />
        <strong>Propiedades:</strong><BR />
        <input type="checkbox" name="propiedades[]" value="sin gluten">Sin gluten
        <input type="checkbox" name="propiedades[]" value="sin lactosa">Sin lactosa
        <input type="checkbox" name="propiedades[]" value="vegano">Vegano
        <input type="checkbox" name="propiedades[]" value="orgánico">Orgánico
        <input type="checkbox" name="propiedades[]" value="sin conservantes">Sin conservantes
        <input type="checkbox" name="propiedades[]" value="sin colorantes">Sin colorantes
        <input type="checkbox" name="propiedades[]" value="prueba">Prueba<br />
        <!-- Unidades: <input type="text" name="unidades" required><br />
        Precio: <input type="text" name="precio" required><br /> -->
        Unidades: <input type="text" name="unidades"><br />
        Precio: <input type="text" name="precio"><br />
        <input type="submit" value="Enviar!">
    </form>
</body>

</html>