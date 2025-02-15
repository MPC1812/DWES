<!-- Mario Puerma Cortés -->
<?php
//Esta función devuelve un array con todos los productos de la base de datos o filtradas por la categoria
function listarProductos(PDO $c, $categoria = ''): array|false
{
    if ($categoria == '') {
        //SQL para obtener todos los productos
        $SQL = 'SELECT * FROM productos';
        try {
            //Se ejecuta la sentencia preparada y se retorna el resultado
            $stmt = $c->prepare($SQL);
            if ($stmt->execute()) { //Puede retornar true o false
                $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
        } catch (PDOException $ex) {
            return false;
        }
    } else {
        //SQL para obtener todos los productos de una categoria
        $SQL = 'SELECT * FROM productos WHERE categoria = :categoria';

        try {
            //Se ejecuta la sentencia preparada y se retorna el resultado
            $stmt = $c->prepare($SQL);
            $stmt->bindValue(':categoria', $categoria);

            if ($stmt->execute()) { //Puede retornar true o false
                $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $datos;
            }
        } catch (PDOException $ex) {
            return false;
        }
    }
}
