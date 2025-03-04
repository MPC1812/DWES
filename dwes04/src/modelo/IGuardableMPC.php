<?php

namespace DWES04\modelo;

/**
 * Interfaz IGuardableMPC.
 * Contiene los métodos que deben implementarse en la clase Libro.
 * @package DWES04\modelo
 * @author Mario Puerma Cortés
 */
interface IGuardableMPC {
    
    public function guardar (\PDO $pdo);

    public static function rescatar (\PDO $pdo, int $id);

    public static function borrar (\PDO $pdo, int $id);
}