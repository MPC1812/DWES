<?php

use function Laravel\Prompts\clear;

require 'vendor/autoload.php';

$url = "http://127.0.0.1:8080/api/login";
session_start();

if ($_POST) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
    $datos = ["email" => $email, "password" => $pass];
    $response = $guzzleClient->post($url, ['form_params' => $datos]);
    $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
    $body = $response->getBody();
    $body = json_decode($body, true);
    //$body = $response->getBody()->getContents(); //Obtener el contenido del cuerpo del mensaje


    switch ($code) {
        case 200:
            $token = $body['token'];
            //$token = (substr($body,37, -2));
            $_SESSION['token'] = $token;
            echo "Usuario logueado correctamente";
            clear();
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
} else if (isset($_SESSION['token'])) {
    echo "Usuario logueado correctamente";
    clear();
} else echo "Rellena el formulario";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="login.php" method="post">

        <div class="container">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" />

            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" />

            <button type="submit">Haz login</button>
        </div>

    </form>
    <style>
        .container {
            width: 200px;
            margin: 0 auto;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            display: block;
            border: none;
            border-bottom: 2px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>


</body>

</html>