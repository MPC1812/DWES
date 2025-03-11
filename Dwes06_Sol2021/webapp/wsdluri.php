<?php

//Script para obtener la ruta al WSDL (no obligatorio)
//Este scritp se prepara para poder cambiar de directorio la aplicación sin problemas.

$baseURL=$_SERVER['REQUEST_URI'];
if (!preg_match("/\/webapp\/?$/",$baseURL)){
    $baseURL= dirname($baseURL);
} 
elseif (substr($baseURL,-1)=='/') 
{
    $baseURL=substr($baseURL,0,-1);
};
$baseURL=str_ireplace('webapp','soapserver',$baseURL);
$wsdluri="http://localhost{$baseURL}/wsdl.php";

return $wsdluri;