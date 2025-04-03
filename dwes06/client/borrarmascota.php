<?php

require 'vendor/autoload.php';

session_start();

if($_POST){
    $id = trim($_POST['id']);
    $url = "http://127.0.0.1:8080/api/mascotasMPC/{$id}";

    $guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
    $response = $guzzleClient->delete($url, [
        'form_params'=>['id'=>$id],
        'headers' => ['Authorization' => 'Bearer ' . $_SESSION['token']]
    ]);
    $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
    $body = $response->getBody();
    $body = json_decode($body, true);

    switch ($code) {
        case 200:
            $mensaje = "Código ".$code." : Borrado correctamente";
            break;
        case 401:
            $mensaje = "Error ".$code." : Solicitud incorrecta";
            break;
        case 403:
            $mensaje = "Error ".$code." : Credenciales no válidas";
            break;
        case 404:
            $mensaje = "Error ".$code." : Mascota no encontrada";
            break;
        default:
            $mensaje = "Error ".$code." : Código de error desconocido";
    } 
} else $mensaje = null;  //Aquí podríamos mostrar un mensaje de error tipo "Rellena y envía el formulario"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar mascota</title>
</head>

<body>
    <?php if (isset($_SESSION['token']) && !isset($mensaje)) { ?>
        <h1>Borrar mascota</h1>
        <form action="borrarmascota.php" method="post">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" required>
            <input type="submit" value="Borrar">
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