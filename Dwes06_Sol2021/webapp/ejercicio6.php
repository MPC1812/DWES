<style>
table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
table th {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
table th,
table td {
    padding: 12px 15px;
}
</style>
<?php

//Determinamos la ruta al descriptor WSDL a partir de la ruta de este script
//Esto permite cambiar la ruta de la aplicación web
$wsdluri=include 'wsdluri.php';
include_once 'lib/Peticion.php';

//Cargamos el formulario
readfile('forms/ejercicio6.form.html');

$p=new Peticion();
    

function listarReservas($reservasWS, $p)
{    
    $datosIdReserva=new class() {};
    $fecha=$p->fecha;
    $zona=$p->getString('zona_id');
    return $reservasWS->listarReservas($fecha,$zona);
}

if ($p->has('zona_id','fecha'))
{
    //Una vez determinada la ruta al descriptor WSDL creamos SoapClient:
    $reservasWS = new SoapClient($wsdluri,array('trace' => 1));  
    $r=listarReservas($reservasWS,$p);
    if (isset($r->fecha) && isset($r->zona) &&
        $r->fecha && $r->zona) 
        {
            isset($r->reservas->tramo) && 
                is_object($r->reservas->tramo)
             && $r->reservas->tramo=[$r->reservas->tramo];            
            
            !isset($r->reservas->tramo) && $r->reservas->tramo=[];

            echo "<H1>Hay ".count($r->reservas->tramo)." reserva/s el día {$r->fecha} en la zona {$r->zona}. </H1>";
            
            if ($r->reservas->tramo)
            {
                echo "<TABLE><TR><TH>Hora de inicio</TH><TH>Hora de fin</TH><TH>Usuario</TH></TR>";
                foreach ($r->reservas->tramo as $tramo)
                {
                    echo "<TR>";
                    echo "<TD>$tramo->horaInicio</TD>";
                    echo "<TD>$tramo->horaFin</TD>";
                    echo "<TD>$tramo->user</TD>";
                    echo "</TR>";
                }
                echo "</TABLE>";
            }
        }
    else
    {
        echo "La zona o la fecha no son correctos.";
    }
    echo "<br>";
    echo "<div><H3>Peticion SOAP enviado al servicio web</H3>".htmlentities($reservasWS->__getLastRequest())."</div>";
    echo "<div><H3>Respuesta SOAP recibida del servicio web</H3>".htmlentities($reservasWS->__getLastResponse())."</div>";
}