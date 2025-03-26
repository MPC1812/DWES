<?php

require __DIR__ . '/vendor/autoload.php';

use TEST\modelo\Impresora;
use TEST\modelo\Impresoras;

try{
    $pdo = new PDO('mysql:dbname=impresoras_db;host=localhost;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { 
    die ('No se pudo conectar a la base de datos: ' . $e->getMessage());
}

$impresora = new Impresora();
$impresora->setNombre('Impresora Test');
$impresora->setTipo(Impresora::TIPOS[0]);
var_dump($impresora->guardar($pdo));
var_dump($impresora->getId());


$impresora_r=Impresora::rescatar($pdo, $impresora->getId());
var_dump($impresora_r);

$impresora_r->setTipo(Impresora::TIPOS[1]);
$impresora_r->guardar($pdo);

$impresora_r2=Impresora::rescatar($pdo, $impresora_r->getId());
var_dump($impresora_r2);

var_dump(Impresoras::obtenerImpresoras($pdo));


$i_b=Impresora::borrar($pdo, $impresora_r->getId());
var_dump($i_b);

