<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'conf.php';
require_once 'controladores.php';

use DWES04\Peticion;

if (!class_exists('Smarty'))
{
    die("No se ha encontrado Smarty. Este proyecto usa composer, por lo que es necesario ejecutar 'composer install'");
}

//Configuramos Smarty:
$smarty = new Smarty();
$smarty->template_dir = TEMPLATE_DIR;
$smarty->compile_dir = TEMPLATE_C_DIR;
$smarty->cache_dir = CACHE_DIR;

//Conectamos a la base de datos:
try {
    $pdoConn = new PDO(DB_DSN, DB_USER, DB_PASSWD, 
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e)
{
    die('Error DB. No se puede continuar. Revisa el valor de las constantes DB_USER y DB_PASSWD en el archivo conf.php.');
}

//Procesamos la petición
$p=new Peticion();

$ruta=$p->getPath(ROOTPATH);

//Enrutado
if ($ruta==='/addactivo')
{
    controladorAddActivo($p, $smarty,$pdoConn);
}
elseif ($ruta==='/listaractivos')
{
    controladorListarActivos($p,$smarty,$pdoConn);
}
elseif ($ruta==='/borraractivo')
{
    controladorBorrarActivo($p,$smarty,$pdoConn);
}
elseif ($ruta==='/editactivo')
{
    controladorEditarActivo($p,$smarty,$pdoConn);
}
else
{
    controladorDefecto($p, $smarty, $ruta);
}
