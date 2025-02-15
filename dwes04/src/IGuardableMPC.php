<?php

namespace DWES04;

interface IGuardableMPC {
    
    //Método a implementar en la clase Activo
    public function guardar (\PDO $pdo);

    //Método a implementar en la clase Activo
    public static function rescatar (\PDO $pdo, int $id);

    //Método a implementar en la clase Activo
    public static function borrar (\PDO $pdo, int $id);
}