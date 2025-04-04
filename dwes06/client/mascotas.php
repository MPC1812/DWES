<?php

require 'vendor/autoload.php';

$url = "http://127.0.0.1:8080/api/mascotasMPC";

session_start();

if (isset($_SESSION['token'])) {
    $guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
    $response = $guzzleClient->get($url, [
        /*'form_params'=>$datos,*/ //Descomentar si fuese necesario
        'headers' => ['Authorization' => 'Bearer ' . $_SESSION['token']]
    ]);
    $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
    $body = $response->getBody()->getContents(); //Obtener el contenido cuerpo del mensaje
    $body = json_decode($body, true);
} else {
    $mensaje = "No hay ninguna sesión abierta, por favor, inicie sesión";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar mascotasMPC</title>
</head>

<body>
    <?php if (isset($_SESSION['token'])) { ?>
        <h1>Listar mascotasMPC</h1>
        <table>
            <thead class="thead-green">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Tipo</th>
                    <th>Me gustas</th>
                </tr>
            </thead>
            <tbody class="tbody-yellow">
                <?php foreach ($body as $mascota) { ?>
                    <tr>
                        <td><?php echo $mascota['id']; ?></td>
                        <td><?php echo $mascota['nombre']; ?></td>
                        <td><?php echo $mascota['descripcion']; ?></td>
                        <td><?php echo $mascota['tipo']; ?></td>
                        <td><?php echo $mascota['megustas']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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