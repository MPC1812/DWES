<?php
require_once __DIR__ . '/comun.php';

use Jaxon\Jaxon;
use Jaxon\Response\Response;
use GuzzleHttp\Client;

$jaxon = jaxon();
$jaxon->setOption("js.lib.uri", BASE_URL . "jaxon-dist");
$jaxon->setOption('core.request.uri', BASE_URL . 'backend.php');

function logMessage(Response $r, mixed $dato)
{
    $r->append('log', 'innerHTML', '<div>' . print_r($dato, true) . '</div>');
}

function funcion1($fechaYhora)
{
    $response = new Response();
    logMessage($response,"La fecha y la hora es: $fechaYhora");
    return $response;
}

function funcion2($nombre)
{
    $response = new Response();
    logMessage($response,"El nombre del autor o autora es $nombre");
    return $response;
}

function listarLibrosAutor ($isbn)
{
    $response = new Response();
    $response->clear('otros_libros_autor');
    $response->assign('otros_libros_autor','innerHTML',"Aquí mostrar libros del autor del libro con ISBN $isbn");
    $response->assign('otros_libros_autor','style.display','block');
    $response->assign('otros_libros_autor','style.border','2px dotted blue');
    $response->assign('otros_libros_autor','style.padding','10px');
    return $response;
}

$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'funcion1');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'funcion2');
$jaxon->register(Jaxon::CALLABLE_FUNCTION, 'listarLibrosAutor');

