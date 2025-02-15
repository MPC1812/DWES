<!-- Mario Puerma Cortés -->
<?php
//Función para actualizar un producto en la base de datos
function actualizarProducto(PDO $c, $id, $unidades): int|false
{
    //SQL para actualizar el número de unidades
    $SQL = 'UPDATE productos SET unidades = :unidades WHERE id = :id';
    /* try catch para evitar errores mediante la ejecución de una sentencia preparada
      si el número de unidades resultante es negativo o cero, se retorna false
      si se actualiza correctamente, se retorna el id del registro nuevo
      si se actualiza incorrectamente, se retorna false*/
    try {
        $stmt = $c->prepare($SQL);
        $stmt->bindValue(':unidades', $unidades+$_POST['original']);
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            $registrosActualizados = $stmt->rowCount();
            if ($registrosActualizados > 0) {
                $idNuevoRegistro = $c->lastInsertId();
                return $idNuevoRegistro;
            }
        }
    } catch (PDOException $ex) {
        echo 'Incremento o decremento de unidades no realizado porque el número de unidades resultante es negativo o cero.';
        return false;
    }
    return false;
}