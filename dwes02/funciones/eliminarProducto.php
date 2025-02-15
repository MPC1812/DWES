<!-- Mario Puerma Cortés -->
<?php
//Función para eliminar un producto en la base de datos
function eliminarProducto(PDO $c, int $id): bool
{
    //SQL para eliminar el producto
    $SQL = 'DELETE FROM productos WHERE id = :id';
    try {
        /* try catch para evitar errores mediante la ejecución de una sentencia preparada
      si se elimina correctamente, se retorna true
      si se elimina incorrectamente, se retorna false
      si se elimina con un error, se retorna false
        */
        $stmt = $c->prepare($SQL);
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            $registrosEliminados = $stmt->rowCount();
            if ($registrosEliminados > 0) {
                return true;
            }
        }
    } catch (PDOException $ex) {
        return false;
    }
    return false;
}