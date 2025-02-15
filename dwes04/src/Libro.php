<?php

namespace DWES04;

class Libro implements IGuardableMPC
{
    private $id = null;
    private $isbn=null;
    private $titulo=null;
    private $autor=null;
    private $anio_publicacion=null;
    private $paginas=null;
    private $ejemplares_disponibles=null;
    private $fecha_creacion=null;
    private $fecha_actualizacion=null;


    public function getid()
    {
        return $this->id;
    }

    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    public function getFechaActualizacion()
    {
        return $this->fecha_actualizacion;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getAnioPublicacion()
    {
        return $this->anio_publicacion;
    }

    public function getPaginas()
    {
        return $this->paginas;
    }

    public function getEjemplaresDisponibles()
    {
        return $this->ejemplares_disponibles;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setAnioPublicacion($anio_publicacion)
    {
        $this->anio_publicacion = $anio_publicacion;
    }

    public function setPaginas($paginas)
    {
        $this->paginas = $paginas;
    }

    public function setEjemplaresDisponibles($ejemplares_disponibles)
    {
        $this->ejemplares_disponibles = $ejemplares_disponibles;
    }

    public function guardar(\PDO $pdo)
    {}

    public static function rescatar (\PDO $pdo, int $id)
    {}

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