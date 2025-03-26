<?php

require 'vendor/autoload.php';

$url = "http://127.0.0.1:8080/api/login";
session_start();

if ($_POST) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);
    $guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
    $datos = ["email" => $email, "password" => $pass];
    $response = $guzzleClient->post($url, ['form_params' => $datos]);
    $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
    $body = $response->getBody();
    $body = json_decode($body, true);


    switch ($code) {
        case 200:
            $token = $body['token'];
            $_SESSION['token'] = $token;
            $mensaje = "Usuario logueado correctamente";
            break;
        case 422:
            $mensaje = "Error 422: Email o password no proporcionados o no válidos";
            break;
        case 401:
            $mensaje = "Error 401: Credenciales no válidas";
            break;
        default:
            $mensaje = "Usuario o contraseñas incorrectos";
    }
} else if (isset($_SESSION['token'])) {
   $mensaje = "Usuario logueado correctamente";
} else $mensaje = "";  //Aquí podríamos mostrar un mensaje de error tipo "Rellena el formulario"

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
<?php if (!$_POST && !isset($_SESSION['token'])) { ?>
    <h1 class="container">Login</h1>
    <form action="login.php" method="post">

        <div class="container">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" />

            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" />

            <button type="submit">Haz login</button>
        </div>

    </form>
    <?php } ?>
    <h3><?php echo $mensaje; ?></h3>
</body>
<style>
        .container {
            width: 200px;
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
</html>