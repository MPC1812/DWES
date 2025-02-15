<?php
session_start();
if (isset($_SESSION['mascota'])) {
        $mascota = $_SESSION['mascota'];
} else {
        $mascota = [];
};
return $mascota;

/*
Deberá retornarse:
- Array vacío si no hay datos en la sesión.
- Array con datos de la mascota si ya está almacenada en la sesión. Fíjate en el script "formnuevamascota.php" y verás que el formato de array esperado es:
        $mascota['nombre']=...
        $mascota['tipo']=...
        $mascota['publica']=...
IMPORTANTE:
 - No debe usarse echo ni print ni nada similar en este script.
 - Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
 - Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
 */
