<?php
include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/conf/conf.php';


use DWES04\Peticion;
use DWES04\IGuardableMPC;
use DWES04\Libros;

//Configuramos Smarty
$smarty = new Smarty();
$smarty->template_dir = __DIR__ . TEMPLATE_DIR;
$smarty->compile_dir = __DIR__ . TEMPLATE_C_DIR;
$smarty->cache_dir = __DIR__ . CACHE_DIR;


/*
//Comprobamos si existe Smarty
if (!class_exists('Smarty')) {
    throw new Exception('No se encontro la clase Smarty');
}

//Comprobamos si existe la clase Peticion
if (!class_exists('DWES04\Peticion')) {
    throw new Exception('No se encontro la clase DWES04\Peticion');
}

//Comprobamos si existe el archivo de configuracion
if (!file_exists(__DIR__ . '/conf.php')) {
    throw new Exception('No se encontro el archivo de configuracion');
}

//Comprobamos si existe el archivo de controladores
if (!file_exists(__DIR__ . '/controladorMPC.php')) {
    throw new Exception('No se encontro el archivo de controladores');
}
*/

//Conectamos a la base de datos
try {
    $pdoConn = new PDO(
        DB_DSN,
        DB_USER,
        DB_PASSWD,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    echo 'Conectado a la base de datos';
} catch (PDOException $e) {
    die('Error DB, no se puede conectar a la base de datos. Revise la configuración.');
}

$libros = new Libros();
$libros->listarMPC($pdoConn);
