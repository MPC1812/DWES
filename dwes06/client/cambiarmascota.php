<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar mascota</title>
</head>

<body>
    <?php if (!isset($_SESSION['token'])) { ?>
        <p><?php echo $mensaje; ?></p>
        <p><a href='login.php'>Iniciar sesión</a></p>
    <?php } ?>
    <?php if (isset($_SESSION['token'])){ ?>
        <h1>Modificar mascota</h1>
        <form action="cambiarubicacion.php" method="post">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" required>
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required>
            <label for="publica">Pública:</label>
            <select name="publica" id="publica" required>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            <input type="submit" value="Modificar">
        </form>
        <?php } ?>
</body>
</html>