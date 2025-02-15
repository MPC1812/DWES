<?php
//session_start();
$mascota = require __DIR__ . '/recuperarMascotaAlmacenadaSesion.php';

if (isset($_POST['nombre']) && isset($_POST['tipo']) && isset($_POST['publica'])) {
    $mascotaSessions['nombre'] = $_POST['nombre'];
    $mascotaSessions['tipo'] = $_POST['tipo'];
    $mascotaSessions['publica'] = $_POST['publica'];
    if (empty($mascota)) {
        $_SESSION['mascota'] = $mascotaSessions;
        //No veo necesaria la notificación ya que el mensaje que se muestra es claro
        $notifs[] = "No existían datos almacenados en la sesión y se ha guardado la sesión con los datos actuales.";
        $resultadoOperacion = SAVED_IN_SESSION;
    } else {
        $_SESSION['mascota'] = $mascotaSessions;
        //No veo necesaria la notificación ya que el mensaje que se muestra es claro
        $notifs[] = "Se han recuperado los datos de la sesión y se han actualizado los datos.";
        $resultadoOperacion = UPDATED_IN_SESSION;
    };
} else {
    $errors[] = "No se han enviado datos al formulario o algunos datos son incorrectos.";
    $resultadoOperacion = ERROR_IN_FORM;
};
return $resultadoOperacion;
/*
Deberá retornarse:
- SAVED_IN_SESSION (100): Si los datos se pudieron guardar por primera vez en la sesión.
- UPDATED_IN_SESSION (200): Si los datos existentes en la sesión fueron actualizados.
- ERROR_IN_FORM (400): Si hay errores en el formulario y no se pudo almacenar o actualizar la mascota en la sesión.
Notas:
 - Las constantes ya están creadas en el script "nuevamascotasesion.php"
 - No debe usarse "echo" ni "print" en este script.
 - Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
 - Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
 
*/
