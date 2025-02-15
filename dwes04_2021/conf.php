<?php

function getPathFirstLevel()
{
    $tmp=array_filter(explode('/',$_SERVER['REQUEST_URI']));
    return '/'.array_shift($tmp)??'';
}

define ('ROOTPATH',getPathFirstLevel());

//Comentar si tu proyecto utiliza composer
//define ('SMARTY_PATH',__DIR__.'\..\smarty\libs');
//set_include_path(SMARTY_PATH);

define ('TEMPLATE_DIR',__DIR__.'\templates');
define ('TEMPLATE_C_DIR',__DIR__.'\templates_c');
define ('CONFIG_DIR',__DIR__.'\config');
define ('CACHE_DIR',__DIR__.'\cache');


define ('DB_DSN','mysql:host=localhost;dbname=convecinos');
//define ('DB_USER','root');
//define ('DB_PASSWD',''); 
define ('DB_USER','dwes');
define ('DB_PASSWD','%DWES4dwes%'); 