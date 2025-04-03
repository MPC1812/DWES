<?php

use function PHPUnit\Framework\isJson;

require 'vendor/autoload.php';

$url = "http://127.0.0.1:8080/api/mascotaMPC/{mascota}";

session_start();

if($request -> isJson()){
    $request->json()->all();
    $id = $request->id;
    $descripcion = $request->descripcion;
    $publica = $request->publica;

    $guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
    $datos = ["id" => $id, "descripcion" => $descripcion, "publica" => $publica];
    $response = $guzzleClient->put($url, [
        'form_params'=>$datos,
        'headers' => ['Authorization' => 'Bearer ' . $_SESSION['token']]
    ]);
    $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
    $body = $response->getBody();
    $body = json_decode($body, true);
} else {
    echo "No es un archivo en formato Json";
}

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
    <?php if (isset($_SESSION['token'])){ ?>
        <h1>Modificar mascota</h1>
        <form action="cambiarubicacion.php" method="post">
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
</body>
</html>