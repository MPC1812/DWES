<?php
require_once 'logger.php';
require_once 'conf/conf.php';
require_once 'src/utils.php';
require_once 'src/ReservasSoapHandler.php';


//Determinamos la ruta al descriptor WSDL a partir de la ruta de acceso
//Esto permite cambiar la ruta de la aplicación web
$baseURL=$_SERVER['REQUEST_URI'];

if (!preg_match("/\/soapserver\/?$/",$baseURL)){
    $baseURL= dirname($baseURL);
} 
elseif (substr($baseURL,-1)=='/') 
{
    $baseURL=substr($baseURL,0,-1);
};
$wsdluri="http://localhost{$baseURL}/wsdl.php";


_l("Iniciando SoapServer con la URL del descriptor WSDL: $wsdluri");
$server = new SoapServer($wsdluri);

$server->setClass('ReservasSoapHandler');
$server->handle();