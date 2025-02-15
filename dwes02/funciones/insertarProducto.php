<!-- Mario Puerma Cortés -->
<?php
//Función para insertar un nuevo producto en la base de datos
function insertarProducto(PDO $c, array $datos): int|false
{
    //SQL para insertar un nuevo producto
    $SQL = 'INSERT INTO productos (nombre, codigo_ean, categoria, propiedades, unidades, precio) VALUES (:nombre, :codigo_ean, :categoria, :propiedades, :unidades, :precio)';
    try {
        /* try catch para evitar errores mediante la ejecución de una sentencia preparada
          si se inserta correctamente, se retorna el id del registro nuevo
          si se inserta incorrectamente, se retorna false
          si se inserta con un error, se retorna false
        */
        $stmt = $c->prepare($SQL);
        $stmt->bindValue(':nombre', $datos['nombre']);
        $stmt->bindValue(':codigo_ean', $datos['codigo_ean']);
        $stmt->bindValue(':categoria', $datos['categoria']);
        $stmt->bindValue(':propiedades', $datos['propiedades']);
        $stmt->bindValue(':unidades', $datos['unidades']);
        $stmt->bindValue(':precio', $datos['precio']);
        if ($stmt->execute()) {
            $registrosInsertados = $stmt->rowCount();
            if ($registrosInsertados > 0) {
                $idNuevoRegistro = $c->lastInsertId();
                return $idNuevoRegistro;
            }
        }
    } catch (PDOException $ex) {
        return false;
    }
    return false; 
}