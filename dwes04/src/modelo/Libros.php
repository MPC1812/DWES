<?php

namespace DWES04\modelo;

/**
 * Clase Libros.
 * Contiene los métodos de la clase Libro. Permite listar los libros almacenados en la base de datos.
 * @package DWES04\modelo
 * @author Mario Puerma Cortés
 */
class Libros
{
    /**
     * Función listarMPC(). Esta función devuelve una lista de libros almacenados en la base de datos.
     * @param \PDO $pdo Instancia válida de la clase PDO con una conexión activa.
     * @param bool $ordenar Indica si se debe ordenar los libros.
     * @return array|int
     * @access public
     */
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
