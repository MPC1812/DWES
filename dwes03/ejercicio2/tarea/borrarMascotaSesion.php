<?php
$mascota = require __DIR__ . '/recuperarMascotaAlmacenadaSesion.php';

    if (empty($mascota)) {
        //No veo necesaria la notificación ya que el mensaje que se muestra es claro
        $notifs[] = "No existe mascota almacenada en la sesión.";
        $resultadoOperacion = NOT_IN_SESSION;
    } else {
        //Eliminamos la mascota de la sesión
        unset($_SESSION['mascota']);
        //No veo necesaria la notificación ya que el mensaje que se muestra es claro
        $notifs[] = "Se ha eliminado la mascota almacenada en la sesión.";
        $resultadoOperacion = DELETED_FROM_SESSION;
    };

return $resultadoOperacion;

/*
Deberá retornarse:
 - DELETED_FROM_SESSION (100): Si los datos de la mascota fueron eliminados exitosamente de la sesión.
 - NOT_IN_SESSION (200): Si no hay datos de la mascota almacenados en la sesión.
Nota:
 - Las constantes ya están creadas en el script "borrarmascota.php"
 - No debe usarse "echo" ni "print" en este script.
 - Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
 - Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
*/
?>
