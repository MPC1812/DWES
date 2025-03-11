<?php


function connect()
{
    static $pdoConn=false;
    try {
        if (!$pdoConn && defined('DB_DSN') && defined('DB_USER') && defined('DB_PASSWD'))
        {
            $pdoConn = new PDO(DB_DSN, DB_USER, DB_PASSWD, 
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
    }
    catch (PDOException $ex)
    {
        function_exists('_l') && _l($ex->getMessage().'<br>'.$ex->getTraceAsString());                        
    }
    return $pdoConn;
}

/**
 * Función que retorna el recuento de solapamientos.
 * @param PDO $pdo Conexión PDO válida.
 * @param string $fecha Fecha de la reserva.
 * @param string $inicio Hora de inicio la reserva.
 * @param string $fin Hora de fin de la reserva.
 * @param string $excepto Hora de inicio a excluir en la verificación (si es null, se ignora).
 * @return mixed - false si se produjo algún error (bool) 
 *               - el número de solapamientos en caso de éxito (int).
 */
function solapamientos (PDO $pdo, int $zona_id, string $fecha, string $inicio, string $fin, string $excepto = null) {

    $retorno=false;
    $query="SELECT count(*) as recuento FROM reservas WHERE fecha=:fecha AND zona_id=:zona_id AND ".
            "( (inicio<=:inicio AND fin>=:inicio) OR ".
            " (inicio>=:fin AND fin<=:fin) OR ".
            " (:inicio<=inicio AND :fin>=inicio) )";
    if ($excepto)
    {
        $query.=" AND inicio<>:excepto";
    }
    
    try {
        $stmt=$pdo->prepare($query);
        $stmt->bindValue('zona_id',$zona_id);
        $stmt->bindValue('fecha',$fecha);
        $stmt->bindValue('inicio',$inicio);        
        $stmt->bindValue('fin',$fin);
        if ($excepto)
        {
            $stmt->bindValue('excepto',$excepto);
        }
        if ($stmt->execute())
        {
            $retorno=intval($stmt->fetchColumn());
        }
    }
    catch (PDOException $ex)
    {
        function_exists('_l') && _l($ex->getMessage().'<br>'.$ex->getTraceAsString());                        
    }
    return $retorno;
}

/**
 * Función que retorna si un tramo existe.
 * @param PDO $pdo Conexión PDO válida.
 * @param string $fecha Fecha de la reserva.
 * @param string $inicio Hora de inicio la reserva.
 * @return mixed 
 *               - false si se produjo algún error (bool)
 *               - 1 en caso de que el tramo exista o 0 en caso de que no exista (int).
 */
function existe (PDO $pdo, string $zona_id, string $fecha, string $inicio) {

    $retorno=false;
    $query="SELECT count(*) as recuento FROM reservas WHERE fecha=:fecha AND ".
            " inicio=:inicio and zona_id=:zona_id";
    try {
        $stmt=$pdo->prepare($query);
        $stmt->bindValue('fecha',$fecha);
        $stmt->bindValue('inicio',$inicio);
        $stmt->bindValue('zona_id',$zona_id);
        if ($stmt->execute())
        {
            $retorno=intval($stmt->fetchColumn());
        }
    }
    catch (PDOException $ex)
    {
        function_exists('_l') && _l($ex->getMessage().'<br>'.$ex->getTraceAsString());                        
    }
    return $retorno;
}

/**
 * Funtión que retorna todas las reservas de un usuario ordenadas.
 * @param PDO $pdo Conexión PDO válida.
 * @param int $user_id Id de usuario.
 * @param string $orden ASC o DESC, si se indica otro valor diferente no
 * se usará un orden.
 * @return mixed false en caso de que se produzca un error o un array
 * con todos los registros encontrados.
 */
function consultarReservas (PDO $pdo, int $user_id, string $orden )
{
    $retorno=false;
    $query="SELECT fecha, inicio, fin as recuento FROM reservas WHERE user_id=:user_id";
    switch ($orden)
    {
        case "ASC":
                $query.=" ORDER BY timestamp(fecha,inicio) ASC";
            break;
        case "DESC":
                $query.=" ORDER BY timestamp(fecha,inicio) DESC";
            break;
    }    
    try {
        $stmt=$pdo->prepare($query);
        $stmt->bindValue('user_id',$user_id);
        if ($stmt->execute())
        {
            $retorno=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch (PDOException $ex)
    {
        function_exists('_l') && _l($ex->getMessage().'<br>'.$ex->getTraceAsString());                        
    }
    return $retorno;
}

/**
 * Funtión que retorna todas las reservas de un usuario ordenadas.
 * @param PDO $pdo Conexión PDO válida.
 * @param int $user_id Id de usuario.
 * @param string $orden ASC o DESC, si se indica otro valor diferente no
 * se usará un orden.
 * @return mixed false en caso de que se produzca un error o un array
 * con todos los registros encontrados.
 */
function consultarReservasZona (PDO $pdo, string $fecha, int $zona_id )
{
    $retorno=false;
    $query="SELECT user_id, inicio, fin FROM reservas WHERE fecha=:fecha AND ".
            "zona_id=:zona_id";
    try {
        $stmt=$pdo->prepare($query);
        $stmt->bindValue('zona_id',$zona_id);
        $stmt->bindValue('fecha',$fecha);
        if ($stmt->execute())
        {
            $retorno=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    catch (PDOException $ex)
    {
        function_exists('_l') && _l($ex->getMessage().'<br>'.$ex->getTraceAsString());                        
    }
    return $retorno;
}

/**
 * Realiza la inserción de una reserva verificando previamente que no 
 * existe otra reserva en ese mismo tramo.
 * @param PDO $pdo Conexión válida a la base de datos.
 * @param array $datosReserva array con los datos de la reserva ['user_id','zona_id','fecha', 'inicio', 'fin']
 *              Nota: la fecha debe ir en formato aaaa-mm-dd
 * @return mixed - false si no se pudo realizar la operación
 *               - -1 si se produce un solapamiento.              
 *               - un número entero mayor de cero con el número de registros insertados en caso de que si se pudiera hacer la operación.
 */
function insertarReserva(PDO $pdo, array $datosReserva)
{
    $retorno = false;
    $campos=['user_id','zona_id','fecha', 'inicio', 'fin'];
    if (!array_diff($campos,array_keys($datosReserva))) {
        $mustCommit=false;
        $pdo->beginTransaction();
        $ns=solapamientos($pdo, $datosReserva['zona_id'], $datosReserva['fecha'],$datosReserva['inicio'],$datosReserva['fin']);
        if ($ns===0)
        {
            $query="INSERT INTO reservas (zona_id, user_id, fecha, inicio, fin) VALUES (:zona_id, :user_id, :fecha, :inicio, :fin)";
            try {
                $stmt=$pdo->prepare($query);
                if ($stmt->execute($datosReserva))
                {
                    $retorno=$stmt->rowCount();
                    $mustCommit=true;
                }            
            } catch (PDOException $ex) {
                function_exists('_l') && _l($ex->getMessage().'<br>'.$ex->getTraceAsString());                        
            }
        }
        elseif (is_int($ns))
        {
            $retorno=-1;
        }

        if ($mustCommit)
            $pdo->commit();        
        else
            $pdo->rollBack();
    }
    return $retorno;
}

/**
 * Realiza la modificación de una reserva verificando previamente que no 
 * existe otra reserva en ese mismo tramo.
 * @param PDO $pdo Conexión válida a la base de datos.
 * @param array $datosReserva array con los datos de modificacíon de reserva ['zona_id', 'fecha_actual', 'inicio_actual', 'nuevo_inicio', 'nuevo_fin']
 *              Nota: la fecha debe ir en formato aaaa-mm-dd
 * @return mixed - false si no se pudo realizar la operación
 *               - -1 si se produce un solapamiento.         
 *               - -2 si la reserva no existe.     
 *               - un número entero mayor de cero con el número de registros insertados en caso de que si se pudiera hacer la operación.
 */
function modificarReserva(PDO $pdo, array $datosReserva)
{
    $retorno = false;
    $campos=['zona_id', 'fecha_actual', 'inicio_actual', 'nuevo_inicio', 'nuevo_fin'];
    if (!array_diff($campos,array_keys($datosReserva))) {
        $mustCommit=false;
        $pdo->beginTransaction();
        //Si la reserva existe y no hay solapamientos excluyendo esta reserva
        if (existe($pdo,$datosReserva['zona_id'], $datosReserva['fecha_actual'],$datosReserva['inicio_actual']))
        {
            if (!solapamientos($pdo,$datosReserva['zona_id'], $datosReserva['fecha_actual'], $datosReserva['nuevo_inicio'], $datosReserva['nuevo_fin'], $datosReserva['inicio_actual']))
            {            
                $query="UPDATE reservas SET inicio=:nuevo_inicio, fin=:nuevo_fin WHERE zona_id=:zona_id AND fecha=:fecha_actual AND inicio=:inicio_actual";
                try {
                        $stmt=$pdo->prepare($query);
                        if ($stmt->execute($datosReserva))
                        {
                            $retorno=$stmt->rowCount();
                            $mustCommit=true;
                        }
                } catch (PDOException $ex) {   
                    function_exists('_l') && _l($ex->getMessage().'<br>'.$ex->getTraceAsString());                        
                }            
            }
            else $retorno=-1;
        }
        else $retorno=-2;

        if ($mustCommit)
            $pdo->commit();        
        else
            $pdo->rollBack();
    }
    return $retorno;
}

/**
 * Realiza la eliminación de una reserva.
 * @param PDO $pdo Conexión válida a la base de datos.
 * @param array $datosReserva array con los datos de reserva a eliminar ['zona_id', 'fecha_actual', 'inicio_actual']
 *              Nota: la fecha debe ir en formato aaaa-mm-dd
 * @return mixed - false si no se pudo realizar la operación
 *               - un número entero con el número de registros eliminados en caso de que si se pudiera hacer la operación.
 */
function eliminarReserva(PDO $pdo, array $datosReserva)
{
    $retorno = false;
    $campos=['zona_id', 'fecha_actual', 'inicio_actual'];
    if (!array_diff($campos,array_keys($datosReserva))) {
        
        $query="DELETE FROM reservas WHERE zona_id=:zona_id AND fecha=:fecha_actual AND inicio=:inicio_actual";
        try{
            $stmt=$pdo->prepare($query);
            if ($stmt->execute($datosReserva))
            {
                $retorno=$stmt->rowCount();        
            }            
        } 
        catch (PDOException $ex)
        {
            function_exists('_l') && _l($ex->getMessage().'<br>'.$ex->getTraceAsString());                        
        }      
    }
    return $retorno;
}