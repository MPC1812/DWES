<?php

namespace DWES04\modelo;

/**
 * Clase Libro.
 * Representa un libro. Contiene los datos del libro. Permite guardar y recuperar los datos.
 * @package DWES04\modelo
 * @author Mario Puerma Cortés
 */
class Libro implements IGuardableMPC
{
    /**
     * Ejemplo de comentario de un atributo.
     * @var int $id Identificador del libro.
     * @access private
     * 
     * @var int $isbn Número de ISBN del libro.
     * @access private
     * ...
     */
    private ?int $id = null;
    private ?int $isbn = null;
    private ?string $titulo = null;
    private ?string $autor = null;
    private ?int $anio_publicacion = null;
    private ?int $paginas = null;
    private ?int $ejemplares_disponibles = null;
    private ?string $fecha_creacion = null;
    private ?string $fecha_actualizacion = null;

    /**
     * Ejemplo de comentario de un método, que devuelve un valor.
     * getId(). Este método devuelve el valor de la variable $id.
     * @return int
     * @access public
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getFechaCreacion(): string
    {
        return $this->fecha_creacion;
    }

    public function getFechaActualizacion(): string
    {
        return $this->fecha_actualizacion;
    }

    public function getIsbn(): int
    {
        return $this->isbn;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getAutor(): string
    {
        return $this->autor;
    }

    public function getAnioPublicacion(): int
    {
        return $this->anio_publicacion;
    }

    public function getPaginas(): int
    {
        return $this->paginas;
    }

    public function getEjemplaresDisponibles(): int
    {
        return $this->ejemplares_disponibles;
    }

    /**
     * Ejemplo de comentario de un método, que guarda un valor.
     * setIsbn(). Este método guarda el valor de la variable $isbn.
     * @param int $isbn Número de ISBN del libro.
     * @access public
     */
    public function setIsbn(int $isbn)
    {
        $this->isbn = $isbn;
    }

    public function setTitulo(string $titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor(string $autor)
    {
        $this->autor = $autor;
    }

    public function setAnioPublicacion(int $anio_publicacion)
    {
        $this->anio_publicacion = $anio_publicacion;
    }

    public function setPaginas(int $paginas)
    {
        $this->paginas = $paginas;
    }

    public function setEjemplaresDisponibles(int $ejemplares_disponibles)
    {
        $this->ejemplares_disponibles = $ejemplares_disponibles;
    }

    /**
     * Función guardar(). Esta función guarda los datos del libro en la base de datos.
     * @param \PDO $pdo Instancia válida de la clase PDO con una conexión activa.
     * @return bool|int
     * @access public
     */
    public function guardar(\PDO $pdo)
    {
        if (is_null($this->id)) // Puedo guardar
        {
            $SQL = 'INSERT INTO libros (isbn, titulo, autor, anio_publicacion, paginas, ejemplares_disponibles, 
            fecha_creacion, fecha_actualizacion) VALUES (:isbn, :titulo, :autor, :anio_publicacion, :paginas, 
            :ejemplares_disponibles, :fecha_creacion, :fecha_actualizacion)';
            try {
                $stmt = $pdo->prepare($SQL);
                $stmt->bindParam('isbn', $this->isbn);
                $stmt->bindParam('titulo', $this->titulo);
                $stmt->bindParam('autor', $this->autor);
                $stmt->bindParam('anio_publicacion', $this->anio_publicacion);
                $stmt->bindParam('paginas', $this->paginas);
                $stmt->bindParam('ejemplares_disponibles', $this->ejemplares_disponibles);
                $stmt->bindParam('fecha_creacion', $this->fecha_creacion);
                $stmt->bindParam('fecha_actualizacion', $this->fecha_actualizacion);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $this->id = $pdo->lastInsertId();
                    return true;
                }
            } catch (\PDOException $e) {
                return -2;
            }
        } else { // Puedo actualizar
            $SQL = 'UPDATE libros SET isbn=:isbn, titulo=:titulo, autor=:autor, anio_publicacion=:anio_publicacion, 
        paginas=:paginas, ejemplares_disponibles=:ejemplares_disponibles WHERE id=:id';
            try {
                $stmt = $pdo->prepare($SQL);
                $stmt->bindValue(':isbn', $this->isbn);
                $stmt->bindValue(':titulo', $this->titulo);
                $stmt->bindValue(':autor', $this->autor);
                $stmt->bindValue(':anio_publicacion', $this->anio_publicacion);
                $stmt->bindValue(':paginas', $this->paginas);
                $stmt->bindValue(':ejemplares_disponibles', $this->ejemplares_disponibles);
                $stmt->bindValue(':id', $this->id);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    return true;
                }
            } catch (\PDOException $e) {
                return -2;
            }
        }
        return false;
    }

    /**
     * Función rescatar(). Esta función recupera los datos del libro de la base de datos.
     * @param \PDO $pdo Instancia válida de la clase PDO con una conexión activa.
     * @param int $id Identificador del libro.
     * @return Libro|int|false
     * @access public
     */
    public static function rescatar(\PDO $pdo, int $id): Libro|int|false
    {
        $SQL = 'SELECT * FROM libros WHERE id=:id';
        try {
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $datos = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($datos) {
                $libro = new Libro();
                $libro->id = $datos['id'];
                $libro->isbn = $datos['isbn'];
                $libro->titulo = $datos['titulo'];
                $libro->autor = $datos['autor'];
                $libro->anio_publicacion = $datos['anio_publicacion'];
                $libro->paginas = $datos['paginas'];
                $libro->ejemplares_disponibles = $datos['ejemplares_disponibles'];
                $libro->fecha_creacion = $datos['fecha_creacion'];
                $libro->fecha_actualizacion = $datos['fecha_actualizacion'];
                return $libro;
            }
        } catch (\PDOException $e) {
            return -2;
        }
        return false;
    }

    /**
     * Función borrar(). Esta función borra los datos del libro de la base de datos.
     * @param \PDO $pdo Instancia válida de la clase PDO con una conexión activa.
     * @param int $id Identificador del libro.
     * @return int|bool
     * @access public
     */
    public static function borrar(\PDO $pdo, int $id): int|bool
    {
        $SQL = 'DELETE FROM libros WHERE id=:id';
        try {
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue('id', $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
               return true;
            }
        } catch (\PDOException $e) {
            return -2;
        }
        return false;
    }
}
