<?php

use function Laravel\Prompts\clear;

require 'vendor/autoload.php';

$url = "http://127.0.0.1:8080/api/login";

if ($_POST) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
        $datos = ["email" => $email, "password" => $pass];
        $response = $guzzleClient->post($url, ['form_params' => $datos]);
        $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
        $body = $response->getBody()->getContents(); //Obtener el contenido del cuerpo del mensaje

        switch ($code) {
            case 200:
                $token = (substr($body,37, -2));
                session_start();
                $_SESSION['token']=$token;
                break;
            case 422:
                echo "Error 422: Email o password no proporcionados o no válidos";
                break;
            case 401:
                echo "Error 401: Credenciales no válidas";
                break;
            default:
                echo "Usuario o contraseñas incorrectos";
        }
} else echo "No se ha recibido ningún dato vía POST";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
    if (isset($_SESSION['token'])) {
        echo "Usuario logueado correctamente";
        clear();
    } 
    ?>
    <form action="login.php" method="post">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" />

        <label for="pass">Password:</label>
        <input type="text" id="pass" name="pass"/>

        <button type="submit">Haz login</button>

    </form>
</body>

</html>