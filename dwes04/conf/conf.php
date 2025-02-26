<!-- Mario Puerma Cortés -->
<?php
//Archivo de configuración del proyecto, este proyecto ha sido creado mediante composer

//Obtener la ruta de la primera carpeta del path
function getPathFirstLevel()
{
    $tmp=array_filter(explode('/',$_SERVER['REQUEST_URI']));
    return '/'.array_shift($tmp)??'';
}

//Obtener la ruta raíz del proyecto
//define ('ROOTPATH',getPathFirstLevel().'/dwes04');
define ('ROOTPATH',getPathFirstLevel());

//Configuración Base de Datos
define ('DB_DSN','mysql:host=localhost;dbname=dwes04');
define ('DB_USER','root');
define ('DB_PASSWD',''); 

//Configuración Smarty
define ('TEMPLATE_DIR', '/templates');
define ('TEMPLATE_C_DIR', '/tmp/compiladas');
define ('CACHE_DIR', '/tmp/cache');

// define ('DB_HOSTNAME','localhost');
// define ('DB_PORT',3306);
// define ('DB_USER','root');
// define ('DB_PASSWORD','');
// define ('DB_SCHEMA','dwes04');

// define ('DB_DSN','mysql:host='.DB_HOSTNAME.';port='.DB_PORT.';dbname='.DB_SCHEMA);

