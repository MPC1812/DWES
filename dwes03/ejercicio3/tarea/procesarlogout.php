<?php

require_once __DIR__ . '/../logout.php';

session_start();

if (isset($_SESSION['logueado']) && $_SESSION['logueado']) {
    unset($_SESSION['logueado']);
    unset($_SESSION['usuario']);
    unset($_SESSION['id']);
    unset($_SESSION['ultimo_acceso']);
    $notifs[] = 'Sesión cerrada';
    return LOGOUT_OK;
} else {
    $errors[] = 'No se ha podido cerrar la sesión porque el usuario no está autenticado';
    return LOGOUT_ERR;
}
/*
Autenticamos al usuario si no esta ya previamente autenticado:

Deberá retornarse:
- LOGOUT_OK (100): Se ha cerrado la sesión de usuario (borrando solo los datos del usuario y respetando otros)
- LOGOUT_ERR (200): No se ha podido autenticar al usuario (usuario no está en la sesión)
Nota:
- Las constantes ya están creadas en el script "logout.php"
- No debe usarse "echo" ni "print" en este script.
- Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
- Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
MUY IMPORTANTE:
- Será un error grave borrar toda la información de la sesión de forma indiscriminada.
*/
