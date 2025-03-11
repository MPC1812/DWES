<?php

//Determinamos la ruta al descriptor WSDL a partir de la ruta de este script
//Esto permite cambiar la ruta de la aplicación web
$wsdluri=include 'wsdluri.php';

include_once 'lib/Peticion.php';

//Cargamos el formulario
readfile('forms/ejercicio4.form.html');

$p=new Peticion();


function crearReserva(SoapClient $reservasWS, Peticion $p)
{    
    
    $datosReserva=new class() {};
    $datosReserva->user=$p->getString('user_id');
    $datosReserva->zona=$p->getString('zona_id');
    $datosReserva->fecha=$p->getString('fecha');;
    $datosReserva->tramo=new class() {};
    $datosReserva->tramo->horaInicio=$p->getString('horainicio');
    $datosReserva->tramo->horaFin=$p->getString('horafin');
    return $reservasWS->crearReserva($datosReserva);
}

if ($p->has('user_id','zona_id','fecha','horainicio','horafin'))
{
    //Una vez determinada la ruta al descriptor WSDL creamos SoapClient:
    $reservasWS = new SoapClient($wsdluri,array('trace' => 1));      
    switch(crearReserva($reservasWS,$p))
        {
            case -1 : $problem='No hay conexión a la base de datos.'; break;
            case -2 : $problem='Problema en el número de usuario o número de reserva'; break;
            case -3 : $problem='Problema en la fecha, la fecha no es correcta.'; break;
            case -4 : $problem='Sección tramo no existente'; break;
            case -5 : $problem='Problema en la hora de inicio'; break;
            case -6 : $problem='Problema en la hora de fin'; break;
            case -7 : $problem='Hora de inicio es mayor o igual a la hora de fin'; break;
            case -100 : $problem='Error al ejecutar la inserción.'; break;
            case -200 : $problem='Solapamiento.'; break;
            default: $problem='Registro insertado.'; break;
        }

        echo "<H2> Resultado de la operación:";
        echo $problem;
        echo "</H2><br>";
        echo "<div><H3>Peticion SOAP enviado al servicio web</H3>".htmlentities($reservasWS->__getLastRequest())."</div>";
        echo "<div><H3>Respuesta SOAP recibida del servicio web</H3>".htmlentities($reservasWS->__getLastResponse())."</div>";

}