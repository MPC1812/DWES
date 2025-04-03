<?php

require 'vendor/autoload.php';

session_start();

if($_POST){
    $id = trim($_POST['id']);
    $descripcion = trim($_POST['descripcion']);
    $publica = $_POST['publica'];

    $url = "http://127.0.0.1:8080/api/mascotasMPC/{$id}";

    $guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
    $datos = ["id" => $id, "descripcion" => $descripcion, "publica" => $publica];
    $response = $guzzleClient->put($url, [
        'json' => $datos,
        'headers' => ['Authorization' => 'Bearer ' . $_SESSION['token']]
    ]);
    $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
    $body = $response->getBody();
    $body = json_decode($body, true);

    switch ($code) {
        case 200:
            $mensaje = "Código ".$code." : Cambio realizado";
            break;
        case 400:
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
    <title>Modificar mascota</title>
</head>

<body>
    <?php if (!isset($_SESSION['token'])) { ?>
        <p>Debe iniciar sesión para acceder a esta página</p>
        <p><a href='login.php'>Iniciar sesión</a></p>
    <?php } ?>
    <?php if (isset($_SESSION['token']) && !isset($mensaje)) { ?>
        <h1>Modificar mascota</h1>
        <form action="cambiarmascota.php" method="post">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" required>
            <label for="descripcion">Descripción:</label>
            <input type="textarea" name="descripcion" id="descripcion" required>
            <label for="publica">Pública:</label>
            <select name="publica" id="publica" required>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
            <input type="submit" value="Actualizar">
        </form>
        <?php } ?>
        <?php if (isset($mensaje) && $mensaje != null) { ?>
            <p><?php echo $mensaje; ?></p>
        <?php } ?>
</body>
</html>