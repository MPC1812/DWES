<?php

namespace DWES04\modelo;

class Libro implements IGuardableMPC
{
    private ?int $id = null;
    private ?int $isbn = null;
    private ?string $titulo = null;
    private ?string $autor = null;
    private ?int $anio_publicacion = null;
    private ?int $paginas = null;
    private ?int $ejemplares_disponibles = null;
    private ?string $fecha_creacion = null;
    private ?string $fecha_actualizacion = null;


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
