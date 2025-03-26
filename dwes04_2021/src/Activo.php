<?php

namespace DWES04;

/*

Clase que modela los datos de un activo, que corresponden con la siguiente tabla de la base de datos:

CREATE TABLE `activos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` tinytext DEFAULT NULL,
  `empresamnt` varchar(45) DEFAULT NULL,
  `contactomnt` varchar(45) DEFAULT NULL,
  `telefonomnt` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) 
*/
class Activo implements IGuardable
{
    //Si es null, significa que el Activo no está guardado
    private $id = null;

    //Nombre del activo. El nombre no puede estar vacío.
    private $nombre; 
    const L_NOMBRE=45;

    //Descripción del activo
    private $descripcion=null;
    const L_DESCRIPCION=255;

    //Empresa que realiza el mantenimiento
    private $empresamnt=null;
    const L_EMPRESAMNT=45;

    //Contacto de mantenimiento
    private $contactomnt=null;
    const L_CONTACTOMNT=45;

    //Teléfono 
    private $telefonomnt;
    const L_TELEFONOMNT=45;
    CONST R_TELEFONOMNT='/^((?:\d{3}[ -]\d{2}[ -]\d{2}[ -]\d{2})|(?:\d{3}[ -]\d{3}[ -]\d{3})|(?:\d{9}))(?:[;](?1))*$/';
    
    /**
     * Obtiene el id (null si es nuevo)
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Establece el nombre del activo.
     */
    public function setNombre(string $nombre)
    {
        $this->nombre=\strip_tags($nombre);
    }

    /**
     * Obtiene el nombre del activo.
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Establece la descripción del activo.
     */
    public function setDescripcion(string $descripcion)
    {
        $this->descripcion=\strip_tags($descripcion);
    }

    /**
     * Obtiene la descripción del activo.
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Establece el nombre de la empresa de mantenimiento.
     */
    public function setEmpresamnt(string $empresamnt) 
    {
        $this->empresamnt=\strip_tags($empresamnt);    
    }

    /**
     * Obtiene el nombre de la empresa de mantenimiento.
     */
    public function getEmpresamnt()
    {
        return $this->empresamnt;
    }

    /**
     * Establece el nombre de las personas de contacto para realizar mantenimiento.
     */
    public function setContactomnt(string $contactomnt)
    {
        $this->contactomnt=\strip_tags($contactomnt);    
    }

    /**
     * Obtiene el nombre de las personas de contacto para realizar mantenimiento.
     */
    public function getContactomnt()
    {
        return $this->contactomnt;
    }

    /**
     * Establece el teléfono de contacto.
     */
    public function setTelefonomnt(string $telefonomnt)
    {
        $this->telefonomnt=\strip_tags($telefonomnt);    
    }

    /**
     * Establece el teléfono de contacto.
     */
    public function getTelefonomnt()
    {
        return $this->telefonomnt;
    }

    /**
     * Comprueba que los datos de los campos son coherentes con lo descrito 
     * en la base de datos y con la lógica interna de la aplicación.
     */
    function checkCoherence()
    {
        $errors=[];

        //Nombre se ha indicado
        if (!is_string($this->nombre) || strlen($this->nombre)==0)
        {
            $errors[]='El nombre es obligatorio y no se ha especificado.';
        }
        //Nombre menor o igual a 45 
        if (is_string($this->nombre) && strlen($this->nombre)>Activo::L_NOMBRE)
        {
            $errors[]='El nombre no puede tener más de '.Activo::L_NOMBRE.' caracteres.';
        }
        //Descripción menor o igual de 255
        if (is_string($this->descripcion) && strlen($this->descripcion)>Activo::L_DESCRIPCION)
        {
            $errors[]='La descripción no puede tener más de '.Activo::L_DESCRIPCION.' caracteres.';
        }
        //Chequeo del nombre de la empresa (empresamnt menor o igual a 45)
        if (is_string($this->empresamnt) && strlen($this->empresamnt)>Activo::L_EMPRESAMNT)
        {
            $errors[]='El nombre de la empresa no puede tener más de '.Activo::L_EMPRESAMNT.' caracteres.';
        }
        //contactomnt menor o igual a 45
        if (is_string($this->contactomnt) && strlen($this->contactomnt)>Activo::L_CONTACTOMNT)
        {
            $errors[]='El nombre del contacto dentro de la emrpesa no puede tener más de '.Activo::L_CONTACTOMNT.' caracteres.';
        }        
        //telefonomnt menor o igual a 45
        if (is_string($this->telefonomnt) && strlen($this->telefonomnt)>Activo::L_TELEFONOMNT)
        {
            $errors[]='Los teléfonos no pueden ocupar más de '.Activo::L_TELEFONOMNT.' caracteres.';
        }
        //telefonomnt sigue expresión regular
        if (is_string($this->telefonomnt) && !preg_match(Activo::R_TELEFONOMNT,$this->telefonomnt))
        {
            $errors[]='Los teléfonos no tienen el formato esperado.';
        }
        return $errors;
    }

    /**
     * Función estática que retorna todos los activos almacenados en la base de datos.
     * @param PDO $pdo Instancia válida de PDO.
     * @return mixed false en caso de error, -1 en caso de excepción y una array con todos los activos
     * en forma de ARRAY de INSTANCIAS de la clase Activo. 
     */
    public static function getAllActivos(\PDO $pdo)
    {
        $ret=false;
        $query='SELECT id, nombre, descripcion, empresamnt, contactomnt, telefonomnt FROM activos';
        try {
            $pdostmt=$pdo->query($query);
            if ($pdostmt)
            {                
                //usar PDO::FETCH_CLASS es solo posible si los campos del select 
                //coinciden con los de la clase, sino hay que usar en el 
                // select alias para cada campo ("SELECT nombre as name, ...")
                $ret=$pdostmt->fetchAll(\PDO::FETCH_CLASS,'DWES04\\Activo');
            }
        }
        catch (\PDOException $e)
        {
            $ret=-1;
        }
        return $ret;
    }

    /**
     * Función estática que almacena o actualiza los datos de una instancia de la base de datos.
     * Nota: no revisa s los campos son correctos, debe llamarse a checkCoherence previamente.
     * @param PDO $pdo Instancia válida de PDO.
     * @return mixed false en caso de error, -1 en caso de excepción o el número de registros insertados o modificados
     * en caso de que todo haya ido bien.
     */
    public function guardar (\PDO $pdo)
    {        
        $ret=false;
        try {
            if (is_null($this->id))
            {
                $query='INSERT INTO activos (nombre, descripcion, empresamnt, contactomnt, telefonomnt)
                        VALUES (:nombre, :descripcion, :empresamnt, :contactomnt, :telefonomnt)';
                $pdostmt=$pdo->prepare($query);

            }
            else
            {
                $query='UPDATE activos SET nombre = :nombre, descripcion = :descripcion, empresamnt = :empresamnt, 
                        contactomnt = :contactomnt, telefonomnt = :telefonomnt WHERE id = :id;';
                $pdostmt=$pdo->prepare($query);
                $pdostmt->bindParam('id', $this->id);
            }
            $pdostmt->bindParam('nombre',$this->nombre);
            $pdostmt->bindParam('descripcion',$this->descripcion);
            $pdostmt->bindParam('empresamnt',$this->empresamnt);
            $pdostmt->bindParam('contactomnt',$this->contactomnt);
            $pdostmt->bindParam('telefonomnt',$this->telefonomnt);
            if ($pdostmt->execute())
            {
                if (is_null($this->id)) $this->id=$pdo->lastInsertId();
                $ret=$pdostmt->rowCount();
            }
        }
        catch (\PDOException $e)
        {
            var_dump($e);
            $ret=-1;
        }
        return $ret;
    }

    /**
     * Función estática que busca un Activo por su id.
     * @param PDO $pdo Instancia válida de PDO.
     * @return mixed false en caso de error, -1 en caso de excepción o una instancia de la clase Activo
     * con el activo resctado en caso de que todo haya ido bien.
     */
    public static function rescatar (\PDO $pdo, int $id)
    {
        $ret=false;
        $query='SELECT id, nombre, descripcion, empresamnt, contactomnt, telefonomnt FROM activos WHERE id=:id';
        try {
            $pdostmt=$pdo->prepare($query);
            $pdostmt->bindParam('id',$id);
            if ($pdostmt->execute())
            {
                //usar PDO::FETCH_CLASS es solo posible si los campos del select 
                //coinciden con los de la clase, sino hay que usar en el 
                // select alias para cada campo ("SELECT nombre as name, ...")
                $pdostmt->setFetchMode(\PDO::FETCH_CLASS, 'DWES04\\Activo');
                $ret=$pdostmt->fetch();
            }
        }
        catch (\PDOException $e)
        {
            $ret=-1;
        }
        return $ret;
    }

    /**
     * Función estática que borra un Activo por su id.
     * @param PDO $pdo Instancia válida de PDO.
     * @param int $id Id del activo.
     * @return mixed false en caso de error, -1 en caso de excepción o un recuento de los activos
     * eliminados en caso de que todo vaya bien.   
     */
    public static function borrar (\PDO $pdo, int $id)
    {
        $ret=false;
        $query='DELETE FROM activos WHERE id=:id';
        try {
            $pdostmt=$pdo->prepare($query);
            $pdostmt->bindParam('id',$id);
            if ($pdostmt->execute())
            {
                $ret=$pdostmt->rowCount();
            }
        }
        catch (\PDOException $e)
        {
            $ret=-1;
        }
        return $ret;
    }

}