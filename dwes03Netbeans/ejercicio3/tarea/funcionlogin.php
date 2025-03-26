<?php
require_once __DIR__ . '/../../etc/config.php';
require_once __DIR__ . '/../../funciones/funciones.php';
require_once __DIR__ . '/../../funciones/dbconn.php';

function login(PDO $c, $user, $pass)
{
    $SQL = "SELECT * FROM usuarios WHERE login = '$user' AND hash_contraseña = $pass";
    //CONSULTA --> SELECT * FROM `usuarios` WHERE `login`="test1" AND `hash_contraseña` = SHA2(CONCAT(REVERSE('test1'), 'TEST', '_28381TXF'), 256);
    //$SQL = 'SELECT * FROM `usuarios` WHERE `login`="' . $usuario . '" AND `hash_contraseña` = "' . $pass . '"';
    try {
        //Se ejecuta la sentencia preparada y se retorna el resultado
        $stmt = $c->prepare($SQL);
        if ($stmt->execute()) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //return $datos;
            if (count($datos) > 0) {
                $_SESSION['id'] = $datos[0]['id'];
                //return $datos;
                return $_SESSION['id'];
            } else {
                $_SESSION['id'] = -99;
                return $_SESSION['id'];
            }
        } else {
            $_SESSION['id'] = -99;
            return $_SESSION['id'];
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        return false;
    }
}



/*
Implementar aquí la función que realiza la autenticación de usuario (solo debe haber una función).
La función debe:
- Recibir por parámetro la conexión a la base de datos (no debe crearse una nueva conexión en su interior)
- Recibir por parámetro el nombre de usuario
- Recibir por parámetro la contraseña
- Retornar el id de usuario (entero  mayor de cero) en caso de autenticación correcta. 
- En caso de autenticación no correcta, retornar un valor que permita saber que ha ocurrido.
IMPORTANTISIMO: Bajo ningún concepto debe usarse en el interior de la función $_POST, ni $_SESSION.
*/
