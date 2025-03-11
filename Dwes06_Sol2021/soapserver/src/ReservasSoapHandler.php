<?php

function esFechaCorrecta($fecha)
{
    try { $d=new DateTime($fecha); } catch (Exception $e) { return false;};
    return $d->getLastErrors()['error_count']==0 && $d->getLastErrors()['warning_count']==0 ;
}

class ReservasSoapHandler
{
    private $PDOconn;
    const HREGEX='/^([01]\d|2[0-3]):([0-5]\d)$/';
    const FREGEX='/^([12]\d{3})-([01]?\d)-([0-3]?\d)$/';    
    
    public function __construct()
    {
        $this->PDOconn=connect();
        if ($this->PDOconn)
            _l('Conectado a la base de datos.');        
        else
            _l('Error conectando a la base de datos.');        
    }

    /**
     * Códigos de error.
     * -1 => No hay conexión a la base de datos.
     * -2 => Problema en $datosReserva->user o $datosReserva->zona
     * -3 => Problema en la fecha
     * -4 => Sección tramo no existente
     * -5 => Problema en la hora de inicio
     * -6 => Problema en la hora de fin
     * -7 => Hora de inicio es mayor o igual a la hora de fin
     * -100 => Error al ejecutar la inserción.
     * -200 => Solapamiento.
     * 1 => Registro insertado.
     */
    public function crearReserva($datosReserva)
    {
        _l("Dato 1 recibido petición crearReserva SOAP:".print_r($datosReserva,true));
        if ($this->PDOconn instanceof PDO)
        {
            if (!isset($datosReserva->user) || !is_numeric($datosReserva->user)) return -2;
            if (!isset($datosReserva->zona) || !is_numeric($datosReserva->zona)) return -2;
            if (!isset($datosReserva->fecha)) return -3;
            
            if (!preg_match(ReservasSoapHandler::FREGEX,$datosReserva->fecha) || 
                !esFechaCorrecta($datosReserva->fecha)) return -3;        

            if (!isset($datosReserva->tramo)) return -4; 
            if (!isset($datosReserva->tramo->horaInicio)) return -5;            
            if (!preg_match(ReservasSoapHandler::HREGEX,$datosReserva->tramo->horaInicio)) return -5;            
            if (!isset($datosReserva->tramo->horaFin)) return -6;
            if (!preg_match(ReservasSoapHandler::HREGEX,$datosReserva->tramo->horaFin)) return -6;                        
            if ($datosReserva->tramo->horaInicio>=$datosReserva->tramo->horaFin) return -7;
            
            $datosDB=[];
            $datosDB['user_id']=$datosReserva->user;
            $datosDB['zona_id']=$datosReserva->zona;
            $datosDB['fecha']=$datosReserva->fecha;
            $datosDB['inicio']=$datosReserva->tramo->horaInicio;
            $datosDB['fin']=$datosReserva->tramo->horaFin;
            $res= insertarReserva($this->PDOconn, $datosDB);
            if ($res===false) 
                return -100;
            else if ($res===-1)
                return -200;
            else 
                return $res;                        
        }
        else
        {
            return -1;
        }
    }

    /**
     * Códigos de error.
     * -1 => No hay conexión a la base de datos.
     * -2 => Problema en $datosReserva->zona
     * -3 => Problema en la fecha
     * -5 => Problema en la hora de inicio actual
     * -6 => Problema en la nueva hora de inicio
     * -7 => Problema en la nueva hora de fin
     * -8 => Problema de concordancia entre nueva hora de inicio y fin
     * -100 => Error al ejecutar la modificación.
     * -200 => Solapamiento
     * -300 => La reserva a modificar no existe
     * 0 => Registro no modificado, pueda que exista pero los datos son los mismo que había.
     * 1 => Registro modificado.
     */
    public function modificarReserva($datosIdReserva, $nuevoTramo)
    {
        _l("Dato 1 recibido petición modificarReserva SOAP:".print_r($datosIdReserva,true));
        _l("Dato 2 recibido petición modificarReserva SOAP:".print_r($nuevoTramo,true));
        if ($this->PDOconn instanceof PDO)
        {
            // Check datosIdReserva
            if (!isset($datosIdReserva->zona) || !is_numeric($datosIdReserva->zona)) return -2;
            if (!isset($datosIdReserva->fecha)) return -3;
            if (!preg_match(ReservasSoapHandler::FREGEX,$datosIdReserva->fecha) || 
                !esFechaCorrecta($datosIdReserva->fecha)) return -3;
            
            if (!isset($datosIdReserva->horaInicio)) return -5;            
            if (!preg_match(ReservasSoapHandler::HREGEX,$datosIdReserva->horaInicio)) return -5;            
            
            //Check nuevoTramo
            if (!isset($nuevoTramo->horaInicio)) return -6;            
            if (!preg_match(ReservasSoapHandler::HREGEX,$nuevoTramo->horaInicio)) return -6;            
            if (!isset($nuevoTramo->horaFin)) return -7;
            if (!preg_match(ReservasSoapHandler::HREGEX,$nuevoTramo->horaFin)) return -7;                        
            if ($nuevoTramo->horaInicio>=$nuevoTramo->horaFin) return -8;
            
            //
            $datosDB['zona_id']=$datosIdReserva->zona;
            $datosDB['fecha_actual']=$datosIdReserva->fecha;
            $datosDB['inicio_actual']=$datosIdReserva->horaInicio;
            $datosDB['nuevo_inicio']=$nuevoTramo->horaInicio;
            $datosDB['nuevo_fin']=$nuevoTramo->horaFin;
            
            $res = modificarReserva($this->PDOconn,$datosDB);
            if ($res===false) return -100;
            elseif ($res==-1) return -200;
            elseif ($res==-2) return -300;
            else return $res;
        }
        else
            return -1;
    }

     /**
     * Códigos de error.
     * -1 => No hay conexión a la base de datos.
     * -2 => Problema en $datosReserva->zona
     * -3 => Problema en la fecha
     * -5 => Problema en la hora de inicio
     * -100 => Error al ejecutar la eliminación.
     * 0 => Registro no existe, no eliminado.
     * 1 => Registro eliminado.
     */
    public function eliminarReserva($datosIdReserva)
    {
        _l("Dato 1 recibido petición eliminarReserva SOAP:".print_r($datosIdReserva,true));
        if ($this->PDOconn instanceof PDO)
        {
            if (!isset($datosIdReserva->zona) || !is_numeric($datosIdReserva->zona)) return -2;
            if (!isset($datosIdReserva->fecha)) return -3;
            if (!preg_match(ReservasSoapHandler::FREGEX,$datosIdReserva->fecha) || 
                !esFechaCorrecta($datosIdReserva->fecha)) return -3;

            if (!isset($datosIdReserva->horaInicio)) return -5;            
            if (!preg_match(ReservasSoapHandler::HREGEX,$datosIdReserva->horaInicio)) return -5;            
            
            $datosDB['zona_id']=$datosIdReserva->zona;
            $datosDB['fecha_actual']=$datosIdReserva->fecha;
            $datosDB['inicio_actual']=$datosIdReserva->horaInicio;
            
            $res = eliminarReserva($this->PDOconn,$datosDB);
            if ($res===false) {
                return -100;
            }
            else return $res;
        }
        else
            return -1;
    }

    public function listarReservas($fecha, $zona)
    {
        _l("Dato 1 recibido petición listarReservas SOAP:".print_r($fecha,true));
        _l("Dato 2 recibido petición listarReservas SOAP:".print_r($zona,true));
        
        $r=new class(){};
        $r->fecha=null;
        $r->zona=null;
        $r->reservas=[];
       
        if ($this->PDOconn instanceof PDO)
        {
            if (!is_numeric($zona)) return $r;            
            if (!preg_match(ReservasSoapHandler::FREGEX,$fecha) || 
                !esFechaCorrecta($fecha)) return $r;
            $r->fecha=$fecha;
            $r->zona=$zona;
            $res=consultarReservasZona($this->PDOconn,$fecha, $zona);
            if (is_array($res))
            {                
                array_walk($res, function ($v) use ($r) {
                    $n=new class() {};                    
                    $n->horaInicio=$v['inicio'];
                    $n->horaFin=$v['fin'];
                    $n->user=$v['user_id'];
                    $r->reservas[]=$n;
                });
            }
            _l("Datos a enviar desde listarReservas".print_r($r,true));
            return $r;        
        }
        else 
            return $r;
    }
}