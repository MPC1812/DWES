<?php

namespace TEST\modelo;
//use TEST\modelo\Impresora; No es necesario porque está en el mismo espacio de nombres.

class Impresoras
{
    public static function obtenerImpresoras(\PDO $pdo): array|int
    {
        try {
            $sql = "SELECT id FROM impresoras";
            $resultado = $pdo->query($sql);
            $impresoras = [];
            foreach ($resultado as $fila) {
                $impresoras[] = Impresora::rescatar($pdo, $fila['id']);
            }
            return $impresoras;
        } catch (\PDOException $e) {
            return -1;
        }
    }
}
