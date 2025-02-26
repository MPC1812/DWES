<?php

namespace DWES04\modelo;

class Libros
{
    public static function listarMPC(\PDO $pdo): array|int
    {
        try {
            $sql = "SELECT * FROM libros";
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
