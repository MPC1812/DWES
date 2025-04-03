<?php

require 'vendor/autoload.php';

$url = "http://127.0.0.1:8080/api/mascotaMPC/{mascota}";

session_start();

$guzzleClient = new GuzzleHttp\Client(['http_errors' => false]);
    $datos = ["nombre" => $nombre, "descripcion" => $descripcion, "tipo" => $tipo, "publica" => $publica];
    $response = $guzzleClient->put($url, [
        'form_params'=>$datos,
        'headers' => ['Authorization' => 'Bearer ' . $_SESSION['token']]
    ]);
    $code = $response->getStatusCode(); //Obtener el código de respuesta HTTP
    $body = $response->getBody();
    $body = json_decode($body, true);

?>