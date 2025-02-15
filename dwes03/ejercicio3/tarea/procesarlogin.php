<?php
require_once 'funcionlogin.php';

session_start();

$conexion = conectar();
if ($_POST) {
    $user = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    //$user = $_POST['login'];
    $password = filter_input(INPUT_POST, 'contraseña');
    //$password = $_POST['contraseña'];
    $pass = "SHA2(CONCAT(REVERSE('$user'), '$password', '_28381TXF'), 256)";
    login($conexion, $user, $pass);
}

try {
    //login($conexion, $user, $pass);
    if ($_SESSION['id'] >= 1) {
        $_SESSION['logueado'] = true;
        if (!isset($_SESSION['ultimo_acceso'])) {
            $_SESSION['ultimo_acceso'] = time();
        }
        $_SESSION['tiempo_transcurrido'] = time() - $_SESSION['ultimo_acceso'];
        if ($_SESSION['tiempo_transcurrido'] <= 600) {
            if (isset($_SESSION['usuario'])) {
                $user = $_SESSION['usuario'];
                $notifs[] = "Ya ha iniciado sesión anteriormente";
                return LOGIN_PREV;
            } else {
                $_SESSION['usuario'] = $user;
                $notifs[] = "Se ha autenticado correctamente";
                return LOGIN_OK;
            }
        } else {
            $_SESSION['logueado'] = false;
            $errors[] = "No se ha podido autenticar al usuario (usuario y/o contraseña incorrectos)";
            return LOGIN_ERR;
        }
    } else {
        $_SESSION['logueado'] = false;
        $errors[] = "No se ha podido autenticar al usuario (usuario y/o contraseña incorrectos)";
        return LOGIN_ERR;
    }
} catch (PDOException $e) {
    $errors[] = $e->getMessage();
    $_SESSION['logueado'] = false;
    return LOGIN_FAIL_DB;
}





/*
Autenticamos al usuario si no esta ya previamente autenticado:

Deberá retornarse:
- LOGIN_OK (100): El usuario se ha autenticado correctgamente y se guarda id y login en la sesión.
- LOGIN_PREV (150): El usuario ya está autenticado (ya ha información en la sesión del usuario)
- LOGIN_ERR (200): No se ha podido autenticar al usuario (usuario y/o contraseña incorrectos)
- LOGIN_FAIL_DB (400): Ha fallado la conexión a la base de datos o se ha producido cualquier otra excepción.
Nota:
- Las constantes ya están creadas en el script "login.php"
- No debe usarse "echo" ni "print" en este script.
- Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
- Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
MUY IMPORTANTE:
- Debes usar la función que has implementado en funcionlogin.php de forma adecuada.
- Será un error EXTREMADAMENTE grave guardar la contraseña de usuario en la sesión.
- Será un error MUY grave guardar el login de usuario en la sesión antes de haberlo autenticado.
- Será un error grave autenticar al usuario cuando su información ya está en la sesión.
*/
