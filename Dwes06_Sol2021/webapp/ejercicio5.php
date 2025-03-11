<?php

//Determinamos la ruta al descriptor WSDL a partir de la ruta de este script
//Esto permite cambiar la ruta de la aplicación web
$wsdluri=include 'wsdluri.php';
include_once 'lib/Peticion.php';

//Función que invoca el método remoto usando los datos recibidos vía POST
function borrarReserva(SoapClient $reservasWS, Peticion $p)
{    
    $datosIdReserva=new class() {};
    $datosIdReserva->zona=$p->zona_id;
    $datosIdReserva->fecha=$p->fecha;
    $datosIdReserva->horaInicio=$p->horainicio;
    return $reservasWS->eliminarReserva($datosIdReserva);
}

//Cargamos el formulario
readfile('forms/ejercicio5.form.html');

$p=new Peticion();

if ($p->has('zona_id','fecha','horainicio'))
{
    //Una vez determinada la ruta al descriptor WSDL creamos SoapClient:
    $reservasWS = new SoapClient($wsdluri, array('trace' => 1));      

    switch(borrarReserva($reservasWS, $p))
    {
        case -1 : $problem='No hay conexión a la base de datos.';break;
        case -2 : $problem='Problema en la zona proporcionada';break;
        case -3 : $problem='Problema en la fecha';break;
        case -5 : $problem='Problema en la hora de inicio';break;
        case -100 : $problem='Error al ejecutar la eliminación.';break;
        case 0 : $problem='Registro no existe, no eliminado.';break;
        case 1 : $problem='Registro eliminado.';break;
        default : $problem = 'Código retornado por servicio SOAP no esperado'; break;
    }

    echo "<H2>Resultado de la operación:";
    echo $problem;
    echo "</H2><br>";
    echo "<div><H3>Peticion SOAP enviado al servicio web</H3>".htmlentities($reservasWS->__getLastRequest())."</div>";
    echo "<div><H3>Respuesta SOAP recibida del servicio web</H3>".htmlentities($reservasWS->__getLastResponse())."</div>";
}