<?php

//Determinamos la ruta al descriptor WSDL a partir de la ruta de este script
//Esto permite cambiar la ruta de la aplicación web
$wsdluri=include 'wsdluri.php';
include_once 'lib/Peticion.php';

//Cargamos el formulario
readfile('forms/ejercicio7.form.html');

$p=new Peticion();

function modificarReserva($reservasWS,Peticion $p)
{    
    $datosIdReserva=new class() {};
    $datosIdReserva->zona=$p->zona_id;
    $datosIdReserva->fecha=$p->fecha;
    $datosIdReserva->horaInicio=$p->horainicio;
    $tramo=new class() {};
    $tramo->horaInicio=$p->nhorainicio;
    $tramo->horaFin=$p->nhorafin;
    return $reservasWS->modificarReserva($datosIdReserva,$tramo);
}

if  ($p->has('zona_id', 'fecha','horainicio','nhorainicio','nhorafin')) {

    //Una vez determinada la ruta al descriptor WSDL creamos SoapClient:
    $reservasWS = new SoapClient($wsdluri,array('trace' => 1));      

    switch(modificarReserva($reservasWS,$p))
    {         
        case 0 : $problem='Registro no modificado, pueda que exista pero los datos son los mismo que había.'; break;
        case 1 : $problem='Registro modificado.';break;
        case -1 : $problem='No hay conexión a la base de datos.';break;
        case -2 : $problem='Problema en la zona proporcionada';break;
        case -3 : $problem='Problema en la fecha';break;
        case -5 : $problem='Problema en la hora de inicio actual';break;
        case -6 : $problem='Problema en la nueva hora de inicio'; break;
        case -7 : $problem='Problema en la nueva hora de fin'; break;
        case -8 : $problem='Problema de concordancia entre nueva hora de inicio y fin'; break;        
        case -100 : $problem='Error al ejecutar la modificación de la reserva';break;
        case -200 : $problem='Solapamiento con otra reserva de ese mismo día'; break;
        case -300 : $problem='La reserva a modificar no existe'; break;

        default : $problem = 'Código retornado por servicio SOAP no esperado'; break;
    }
    echo "<H2> Resultado de la operación: ";
    echo $problem;
    echo "</H2><br>";
    echo "<div><H3>Peticion SOAP enviado al servicio web</H3>".htmlentities($reservasWS->__getLastRequest())."</div>";
    echo "<div><H3>Respuesta SOAP recibida del servicio web</H3>".htmlentities($reservasWS->__getLastResponse())."</div>";
}