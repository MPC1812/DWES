<!-- Mario Puerma Cortés -->
<?php
require_once __DIR__ . '/../etc/conf.php';
/*Función para conectar a la base de datos con atributos para que lanze excepciones y errores de conexión, 
además por seguridad los datos de conexión están en un archivo separado*/
function conectarBD()
{
    try {
        $c = new PDO(DB_DSN, DB_USER, DB_PASS);
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $c;
        echo 'Conexión a la base de datos realizada correctamente.<br/>';
    } catch (PDOException $e) {
        //echo 'Error interno. Por favor consulte la aplicación más tarde. ' . $e->getMessage() . '<br/>';
        die ('Imposible conectar a la base de datos, verifique el mensaje de error.<br/>'.'<strong>ERROR: ' . $e->getMessage().'</strong>');
    }
}
