<?php

namespace DWES04;

class Libros
{
    public static function listarMPC(\PDO $pdo)
    {
        $ret = false;
        $query = 'SELECT * FROM libros';
        try {
            $pdostmt = $pdo->query($query);
            if ($pdostmt) {
                //usar PDO::FETCH_CLASS es solo posible si los campos del select 
                //coinciden con los de la clase, sino hay que usar en el 
                // select alias para cada campo ("SELECT nombre as name, ...")
                $ret = $pdostmt->fetchAll(\PDO::FETCH_CLASS, 'DWES04\\Libro');
                var_dump($ret);
            }
        } catch (\PDOException $e) {
            $ret = -1;
        }
        return $ret;
    }
}
