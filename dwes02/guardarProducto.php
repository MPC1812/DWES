<!-- Mario Puerma Cortés -->
<?php
require_once __DIR__ . '/funciones/conectarBD.php';
require_once __DIR__ . '/funciones/validarPropiedades.php';
require_once __DIR__ . '/funciones/insertarProducto.php';
require_once __DIR__ . '/funciones/validarCategoria.php';
//require_once __DIR__ . '/funciones/fun_post.php';


$errores = []; //array para guardar los errores
$conexion = conectarBD(); //conexión a la base de datos


/*
    Se sanearán datos como por ejemplo el nombre, el EAN, el precio y las unidades eliminando espacios anteriores y posteriores.
    Se transformará el nombre de producto en minúsculas.
    Se verificarán los datos recibidos conforme a lo especificado al comienzo de este ejercicio.
    Se usará la función anterior para guardar los datos solo si todos los datos recibidos son correctos.
    Si los datos recibidos no son correctos, se mostrarán los errores y finalizará la ejecución. Opcionalmente, 
    puedes volver a mostrar el formulario rellenando los datos previamente enviados que sean correctos.
*/
//Comprobamos que exista el nombre, le quitamos espacios y lo transformo en minúsculas si cumple con los criterios.
if (isset($_POST['nombre'])) {
    $_POST['nombre'] = trim($_POST['nombre']);
    if (strlen($_POST['nombre']) > 0 && strlen($_POST['nombre']) <= 30) {
        $_POST['nombre'] = strtolower($_POST['nombre']);
    } else {
        $_POST['nombre'] = NULL;
        $errores[] = "El nombre no cumple con los criterios, tiene que tener entre 1 y 30 caracteres.";
    }
} else {
    $_POST['nombre'] = NULL;
    $errores[] = "No se ha introducido ningún nombre";
}

//Comprobamos que exista el código EAN, le quitamos espacios y compruebo si cumple con los criterios.
if (isset($_POST['codigo_ean'])) {
    $_POST['codigo_ean'] = trim($_POST['codigo_ean']);
    if (strlen($_POST['codigo_ean']) >= 8 && strlen($_POST['codigo_ean']) <= 13 && is_numeric($_POST['codigo_ean'])) {
        $_POST['codigo_ean'] = $_POST['codigo_ean'];
    } else {
        $_POST['codigo_ean'] = NULL;
        $errores[] = "El código EAN no es correcto, tiene que tener 8 a 13 caracteres y ser numérico.";
    }
} else {
    $_POST['codigo_ean'] = NULL;
    $errores[] = "No se ha introducido ningún código EAN.";
}

//Comprobamos que exista la cantidad de unidades, le quitamos espacios y compruebo si cumple con los criterios.
if (isset($_POST['unidades'])) {
    $_POST['unidades'] = trim($_POST['unidades']);
    if (filter_var($_POST['unidades'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
        $_POST['unidades'] = $_POST['unidades'];
    } else {
        $_POST['unidades'] = NULL;
        $errores[] = "La cantidad de unidades no es correcta, tiene que ser un número entero positivo.";
    }
} else {
    $_POST['unidades'] = NULL;
    $errores[] = "No se ha introducido ninguna cantidad de unidades.";
}

//Comprobamos que exista el precio, le quitamos espacios y compruebo si cumple con los criterios.
if (isset($_POST['precio'])) {
    $_POST['precio'] = trim($_POST['precio']);
    if (filter_var($_POST['precio'], FILTER_VALIDATE_FLOAT, ['options' => ['min_range' => 0.01]])) {
        $_POST['precio'] = $_POST['precio'];
    } else {
        $_POST['precio'] = NULL;
        $errores[] = "El precio no es correcto, tiene que ser un número positivo.";
    }
} else {
    $_POST['precio'] = NULL;
    $errores[] = "No se ha introducido ningún precio.";
}

//Comprobamos que exista la categoria, le quitamos espacios y compruebo si cumple con los criterios.
if (isset($_POST['categoria'])) {
    //$_POST['categoria'] = trim($_POST['categoria']); No es necesario quitar espacios, ya que se hace en el select
    if (validarCategoria($_POST['categoria'])===false) {
        $_POST['categoria'] = NULL;
        $errores[] = "La categoria no es correcta.";
    }
}

//Si recibimos propiedades validas, las convertimos en una cadena separada por comas
if (isset($_POST['propiedades'])) {
    if (validarPropiedades($_POST['propiedades'])) $_POST['propiedades'] = implode(',', $_POST['propiedades']);
    else {
        $_POST['propiedades'] = NULL;
        $errores[] = "Las propiedades no son correctas o ha marcado la casilla de prueba.";
    }
} else $_POST['propiedades'] = NULL;



if (count($errores) > 0) {
    foreach ($errores as $error) {
        echo ("$error<br />");
    }
    die("Corrija los errores y vuelva a intentarlo.");
} else {
    $insertar = insertarProducto($conexion, [
        'nombre' => $_POST['nombre'],
        'codigo_ean' => $_POST['codigo_ean'],
        'unidades' => $_POST['unidades'],
        'precio' => $_POST['precio'],
        'propiedades' => $_POST['propiedades'],
        'categoria' => $_POST['categoria']
    ]);
    if ($insertar === false) {
        $errores[] = 'Error al insertar el producto, el código EAN ya existe';
        die("Error al insertar el producto, el código EAN ya existe. Corrija el error y vuelva a intentarlo.");
    } else {
        echo ("El producto ha sido insertado correctamente.");
        die();
    }
}
