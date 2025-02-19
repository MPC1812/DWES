<?php
require_once 'vendor/autoload.php';

//use TEST\helper;
//use TEST\helper as myhelper; Podemos personalizar el nombre de la clase
//use TEST\modelo\Impresora;
use TEST\controladores\Controlador;

//$numeroAlAzar=helper::randomNumber();
//$numeroAlAzar=myhelper::randomNumber();

//var_dump(TEST\modelo\Impresora::TIPOS);

//echo "El número al azar es: " . $numeroAlAzar;

$pdo = new PDO('mysql:dbname=impresoras_db;host=localhost;port=3306;charset=utf8' ,'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

$smarty = new Smarty();
$smarty->template_dir=__DIR__.'/templates';
$smarty->compile_dir=__DIR__.'/tmp/compiladas';
$smarty->cache_dir=__DIR__.'/tmp/cache';

//$listadoImpresoras=Impresora::obtenerImpresoras($pdo);
//var_dump($listadoImpresoras);
Controlador::mostrarNumeroAlAzar($smarty);

