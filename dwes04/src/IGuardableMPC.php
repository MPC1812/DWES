<?php

namespace DWES04\modelo;

interface IGuardableMPC {
    
    //Método a implementar en la clase Libro
    public function guardar (\PDO $pdo);

    //Método a implementar en la clase Libro
    public static function rescatar (\PDO $pdo, int $id);

    //Método a implementar en la clase Libro
    public static function borrar (\PDO $pdo, int $id);
}