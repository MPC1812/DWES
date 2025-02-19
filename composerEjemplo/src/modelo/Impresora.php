<?php

namespace TEST\modelo;


class Impresora
{
    const TIPOS = ['inyección de tinta', 'láser', 'matricial'];

    public static function obtenerImpresoras(\PDO $pdo)
    {
        try {
            $query = "SELECT * FROM impresoras";
            $r=$pdo->query($query);
            return $r->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return -1;
        }
    }
        
}