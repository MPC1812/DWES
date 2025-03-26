<?php
require 'vendor/autoload.php';

$url = "http://127.0.0.1:8080/api/logout";

session_start();

if (isset($_SESSION['token'])) {
    $guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
    $response = $guzzleClient->post($url, [
        /*'form_params'=>$datos,*/ //Descomentar si fuese necesario
        'headers' => ['Authorization' => 'Bearer ' . $_SESSION['token']]
    ]);
    $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
    $body = $response->getBody(); //Obtener el cuerpo del mensaje
    $body = json_decode($body, true);

    switch ($code) {
        case 200:
            unset($_SESSION['token']);
            echo "Has cerrado sesión correctamente";
            break;
        case 401:
            echo "Error 401: Acceso no autorizado";
            break;
        default:
            echo "Revisa el código de respuesta del servidor";
    }
} else echo "No hay ninguna sesión abierta";
