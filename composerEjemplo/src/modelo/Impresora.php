<?php

namespace TEST\modelo;


class Impresora
{
    const TIPOS = ['inyección de tinta', 'láser', 'matricial'];
    private ?int $id=null; //?int indica que puede ser null o entero
    private ?string $tipo;
    private ?string $nombre;

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function setTipo(string $tipo)
    {
        if (in_array($tipo, Impresora::TIPOS)) {
            $this->tipo = $tipo;
        } else {
            throw new \Exception('Tipo de impresora no válido');
        }
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function guardar(\PDO $pdo)
    {
        if (is_null($this->id)) // Puedo guardar
        {
            $SQL = "INSERT INTO impresoras (tipo, nombre) VALUES (:tipo, :nombre)";
            try {
                $stmt = $pdo->prepare($SQL);
                $stmt->bindParam(':tipo', $this->tipo);
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $this->id = $pdo->lastInsertId();
                    return true;
                }
            } catch (\PDOException $e) {
                return -2;
            }
        } 
        else // Puedo actualizar
        {
            $SQL = 'UPDATE impresoras SET nombre=:nombre, tipo=:tipo WHERE id=:id';
            try {
                $stmt = $pdo->prepare($SQL);
                $stmt->bindValue(':tipo', $this->tipo);
                $stmt->bindValue(':nombre', $this->nombre);
                $stmt->bindValue(':id',$this->id);
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

    static function rescatar(\PDO $pdo, int $id): Impresora|int|false
    {
        $SQL = 'SELECT * FROM impresoras WHERE id=:id';
        try {
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $datos = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($datos) {
                $impr = new Impresora();
                $impr->id = $datos['id'];
                $impr->tipo = $datos['tipo'];
                $impr->nombre = $datos['nombre'];
                return $impr;
            }
        } catch (\PDOException $e) {
            return -2;
        }
        return false;
    }
    public static function borrar(\PDO $pdo, int $id): int|bool
    {
        $SQL = 'DELETE FROM impresoras WHERE id=:id';
        try {
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            }
        } catch (\PDOException $e) {
            return -2;
        }
        return false;
    }

    /*public static function obtenerImpresoras(\PDO $pdo)
    {
        try {
            $query = "SELECT * FROM impresoras";
            $r = $pdo->query($query);
            return $r->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return -1;
        }
    }*/
}
