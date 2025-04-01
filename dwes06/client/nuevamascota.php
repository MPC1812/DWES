<?php

require 'vendor/autoload.php';

$url = "http://127.0.0.1:8080/api/crearmascotaMPC";

session_start();


if ($_POST) {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $tipo = trim($_POST['tipo']);
    $publica = trim($_POST['publica']);

    $guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
    $datos = ["nombre" => $nombre, "descripcion" => $descripcion, "tipo" => $tipo, "publica" => $publica];
    $response = $guzzleClient->post($url, [
        'form_params'=>$datos,
        'headers' => ['Authorization' => 'Bearer ' . $_SESSION['token']]
    ]);
    $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
    $body = $response->getBody();
    $body = json_decode($body, true);


    switch ($code) {
        case 200:
            $mensaje = "Código ".$code." : Creado correctamente";
            break;
        case 400:
            $mensaje = "Error ".$code." : Solicitud incorrecta";
            break;
        case 401:
            $mensaje = "Error ".$code." : Credenciales no válidas";
            break;
        default:
            $mensaje = "Error ".$code." : Código de error desconocido";
    }
// } else if (isset($_SESSION['token'])) {
//    $mensaje = "Usuario logueado correctamente";
} else $mensaje = null;  //Aquí podríamos mostrar un mensaje de error tipo "Rellena el formulario"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva mascotasMPC</title>
</head>

<body>
    <?php if (isset($_SESSION['token']) && !isset($mensaje)) { ?>
        <h1>Nueva mascotasMPC</h1>
        <form action="nuevamascota.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required>
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="Perro">Perro</option>
                <option value="Gato">Gato</option>
                <option value="Pájaro">Pájaro</option>
                <option value="Dragón">Dragón</option>
                <option value="Conejo">Conejo</option>
                <option value="Hamster">Hamster</option>
                <option value="Tortuga">Tortuga</option>
                <option value="Pez">Pez</option>
                <option value="Serpiente">Serpiente</option>
                <option value="Prueba">Prueba</option>
            </select>
            <label for="publica">Pública:</label>
            <select name="publica" id="publica" required>
                <option value="Si">Si</option>
                <option value="No">No</option>
                <option value="Prueba">Prueba</option>
            </select>
            <input type="submit" value="Crear">
        </form>
    <?php } ?>
    <?php if (isset($mensaje) && $mensaje != null) { ?>
        <p><?php echo $mensaje; ?></p>
    <?php } ?>
    <?php if (!isset($_SESSION['token'])) { ?>
        <p><?php echo $mensaje; ?></p>
        <p><a href='login.php'>Iniciar sesión</a></p>
    <?php } ?>
</body>
<style>
    body {
        background-color: rgb(255, 255, 255);
    }

    table {
        border-collapse: collapse;
    }

    th {
        background-color: rgb(98, 186, 98);
        color: rgb(255, 255, 255);
        padding: 10px;
        border-radius: 10px;
    }

    td {
        background-color: rgb(255, 255, 0);
        padding: 10px;
        text-align: center;
    }
</style>

</html>