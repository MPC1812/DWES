<?php
//Variables a tener en cuenta:
//$mascotaspreferidas: array con los tipos de mascotas que el usuario ha elegido
//$TIPOS_DE_MASCOTAS es una constante que contiene los tipos de mascotas, ["Perro", "Gato", "Pájaro", "Dragón", "Conejo", "Hamster", "Tortuga", "Pez", "Serpiente"];
require_once __DIR__ . '/../../etc/config.php';
require_once __DIR__ . '/../../funciones/funciones.php';
require_once __DIR__ . '/../../funciones/dbconn.php';

//Definición de constantes
define('SALT', 'salteado');

//Definición de variables
$restablecer = filter_input(INPUT_POST, 'restablecer');
$mascota_de_usuario = filter_input_array(INPUT_POST);
$mascotas_recibidas_de_cookie = filter_input(INPUT_COOKIE, 'tipos_mascotas_MPC');
$mascotas_recibidas_de_cookie_HASH = filter_input(INPUT_COOKIE, 'hash_tipos_mascotas_MPC');

//Si pulsamos y existen las cookies, las borrará y dejará el formulario por defecto
if ($restablecer && $mascotas_recibidas_de_cookie) {
    $mascotaspreferidas = [];
    setcookie('tipos_mascotas_MPC', serialize($mascotaspreferidas), time() - 600);
    setcookie('hash_tipos_mascotas_MPC', hash('sha256', SALT . serialize($mascotaspreferidas) . SALT), time() - 600);
    $notifs[] = "Se han restablecido los datos de preferencia de mascotas.";
    return TIPOS_DE_MASCOTAS;
}
// Si pulsamos el botón y no existen las cookies, se devolverá el formulario por defecto
if ($restablecer) {
    $notifs[] = "No tenemos preferencias de mascotas guardadas, se devolverá el formulario por defecto.";
    return TIPOS_DE_MASCOTAS;
}

/*Como el botón Seleccionas no lo recibimos por post, miro si recibo por POST un array de mascotas seleccionadas por el usuario
además que no esté vacío y que no sea null, si esto se cumple, miro si tengo cookies, si existen, las borro para crear y continuo
crear las nuevas cookies con las preferencias marcadas*/
if (is_array($mascota_de_usuario) && !empty($mascota_de_usuario) && $mascota_de_usuario!==null) {
    if ($mascotas_recibidas_de_cookie) {
        $mascotaspreferidas = [];
        setcookie('tipos_mascotas_MPC', serialize($mascotaspreferidas), time() - 600);
        setcookie('hash_tipos_mascotas_MPC', hash('sha256', SALT . serialize($mascotaspreferidas) . SALT), time() - 600);
    }
    foreach ($mascota_de_usuario['tipos'] as $tipo) {
        if (in_array($tipo, TIPOS_DE_MASCOTAS)) {
            $mascotaspreferidas[] = $tipo;
        }
    }
    setcookie('tipos_mascotas_MPC', serialize($mascotaspreferidas), time() + 600);
    setcookie('hash_tipos_mascotas_MPC', hash('sha256', SALT . serialize($mascotaspreferidas) . SALT), time() + 600);
    $notifs[] = "Se han guardado las preferencias de mascotas.";
    return $mascotaspreferidas;
} 
//Si no recibimos el array, miro si tengo cookies para mostrarlas como preferencias del usuario
elseif (is_string($mascotas_recibidas_de_cookie) && hash('sha256', SALT . $mascotas_recibidas_de_cookie . SALT) == $mascotas_recibidas_de_cookie_HASH) {
    $mascotaspreferidas = unserialize($mascotas_recibidas_de_cookie);
    $notifs[] = "Se cargan las preferencias de mascotas guardadas anteriormente.";
    return $mascotaspreferidas;
} 
//Si no tenemos cookies, devolvemos el formulario por defecto
else {
    $error[] = "No se han seleccionado mascotas o se han introducido datos incorrectos.";
    return TIPOS_DE_MASCOTAS;
}



















/*if ($restablecer && $cookieTiposMascotas) {
    $mascotaspreferidas = [];
    setcookie('tipos_mascotas_MPC', serialize($mascotaspreferidas), time() - 600);
    setcookie('hash_tipos_mascotas_MPC', hash('sha256', SALT . serialize($mascotaspreferidas) . SALT), time() - 600);
    return TIPOS_DE_MASCOTAS;
    echo "<script>alert('Se han restablecido los datos de preferencia de mascotas.');</script>";
}*/




/*setcookie('tipos_mascotas_MPC', serialize($mascotaspreferidas), time() + 600);
setcookie('hash_tipos_mascotas_MPC', hash('sha256', SALT . serialize($mascotaspreferidas) . SALT), time() + 600);

var_dump($_COOKIE);
var_dump($_POST);

if (empty($mascotaspreferidas)) {
    $error[] = "No se han seleccionado mascotas.";
    echo "<script>alert('No se han seleccionado mascotas.');</script>";
    return TIPOS_DE_MASCOTAS;
} else {
    $error[] = "Se ha producido un error al procesar los datos de la preferencia de mascotas.";
    return TIPOS_DE_MASCOTAS;
}*/
