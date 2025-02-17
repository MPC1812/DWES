<?php
require_once 'vendor/autoload.php';

use TEST\helper;
//use TEST\helper as myhelper; Podemos personalizar el nombre de la clase
use TEST\modelo\Impresora;

$numeroAlAzar=helper::randomNumber();
//$numeroAlAzar=myhelper::randomNumber();

var_dump(TEST\modelo\Impresora::TIPOS);

echo "El número al azar es: " . $numeroAlAzar;

$pdo = new PDO('mysql:dbname=impresoras_db;host=localhost;port=3306' ,'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

$listadoImpresoras=Impresora::obtenerImpresoras($pdo);
var_dump($listadoImpresoras);

$smarty = new Smarty();
$smarty->template_dir=__DIR__.'/templates';
$smarty->compile_dir=__DIR__.'/tmp/compiladas';
$smarty->cache_dir=__DIR__.'/tmp/cache';

$smarty->assign('numeroAlAzar', $numeroAlAzar);
$smarty->display('lista.tpl');
//var_dump(TEST\modelo\Impresora::obtenerImpresoras($pdo));