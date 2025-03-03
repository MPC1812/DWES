<?php

namespace DWES04\modelo;

class Libros
{
    public static function listarMPC(\PDO $pdo, bool $ordenar): array|int
    {
        if ($ordenar){$sql = "SELECT * FROM libros ORDER BY fecha_creacion DESC";}
        else{$sql = "SELECT * FROM libros ORDER BY fecha_actualizacion DESC";}
        try {
            $resultado = $pdo->query($sql);
            $libros = [];
            foreach ($resultado as $fila) {
                $libros[] = Libro::rescatar($pdo, $fila['id']);
            }
            return $libros;
        } catch (\PDOException $e) {
            return -1;
        }
    }
}
