 <?php

session_start();

    if (isset ($_SESSION['logueado']) && $_SESSION['logueado']) {
        $ultimo_acceso = $_SESSION['ultimo_acceso'];
        $tiempo_trascurrido = time() - $ultimo_acceso;
        if ($tiempo_trascurrido > 600) {
            unset($_SESSION['logueado']);
            unset($_SESSION['usuario']);
            unset($_SESSION['id']);
            unset($_SESSION['ultimo_acceso']);
            return array();
        } else {
            $_SESSION['ultimo_acceso'] = time();
            $ultimo_acceso = $_SESSION['ultimo_acceso'];
            $notifs[] = "Se ha actualizado el tiempo de acceso.";
            return array('login' => $_SESSION['usuario'], 'id_usuario' => $_SESSION['id'], 'ultimo_acceso' => $ultimo_acceso, 'tiempo_transcurrido' => $tiempo_trascurrido);
        }
    } else {
        return array();
    }
    


/*
Deberá retornarse:
- Array vacío si no hay datos del usuario autenticado en la sesión.
- Array con nombre de usuario (key "login"), último acceso ("ultimo_acceso") y tiempo transcurido desde el último acceso ("tiempo_trascurrido") 
en caso de que haya información almacenada en la sesión del usuario y no haya superado el tiempo de inactividad (10 minutos)

IMPORTANTE:

Este script es responsable de controlar el tiempo de inactividad (10 minutos). La información de la sesión "ultimo_acceso"
debe incorporarse como medida para controlar el tiempo de inactividad. 
- Si la inactividad es menor de 10 minutos: se renueva el tiempo de acceso.
- Si la inactividad es mayor de 10 minutos: se elimina la información de usuario (respetando el resto de información que pudiera existir)

Nota:
- No debe usarse "echo" ni "print" en este script.
- Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
- Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)

*/