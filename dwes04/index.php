<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/conf/conf.php';

use DWES04\controladores\ControladorMPC;
use DWES04\Peticion as Peticion;

//Comprobamos si existe Smarty
if (!class_exists('Smarty')) {
    throw new Exception('No se encontro la clase Smarty');
}
//Configuramos Smarty
$smarty = new Smarty();
$smarty->template_dir = __DIR__ . TEMPLATE_DIR;
$smarty->compile_dir = __DIR__ . TEMPLATE_C_DIR;
$smarty->cache_dir = __DIR__ . CACHE_DIR;

//Comprobamos si existe el archivo de configuracion
if (!file_exists(__DIR__ . '/conf/conf.php')) {
    throw new Exception('No se encontro el archivo de configuracion');
}

//Conectamos a la base de datos
try {
    $pdoConn = new PDO(
        DB_DSN,
        DB_USER,
        DB_PASSWD,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Error DB, no se puede conectar a la base de datos. Revise la configuración.');
}

//Comprobamos si existe el archivo de controladores
if (!file_exists(__DIR__ . '/src/controladores/ControladorMPC.php')) {
    throw new Exception('No se encontro el archivo de controladores');
}

//Comprobamos si existe la clase Peticion
if (!file_exists(__DIR__ . '/src/Peticion.php')) {
    throw new Exception('No se encontro la clase Peticion');
}
//Procesamos la petición
$p=new Peticion();
$ruta=$p->getPath();

//Enrutado
if ($ruta==='/dwes04/index.php')
{
    ControladorMPC::mostrarLibros($p,$smarty,$pdoConn);
}
elseif ($ruta==='/dwes04/mostrarlibros')
{

    ControladorMPC::mostrarLibros($p,$smarty,$pdoConn);
}
else
{
    ControladorMPC::controladorDefecto($p, $smarty, $ruta, $pdoConn);
}

if (isset($_GET['accion'])) {
    if ($_GET['accion']==='nuevo_libro_form_MPC')
{
    ControladorMPC::formlibro($smarty);
}
    if ($_GET['accion']==='crear_libro_MPC')
{
    ControladorMPC::guardarLibro($p,$smarty,$pdoConn);
}
    if ($_GET['accion']==='borrar_libro_MPC')
{
    ControladorMPC::borrarLibro($p,$smarty,$pdoConn);
}
}