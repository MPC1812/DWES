<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/conf/conf.php';

use DWES04\modelo\Libro;
use DWES04\modelo\Libros;


try {
    $pdo = new PDO(
        DB_DSN,
        DB_USER,
        DB_PASSWD,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Error DB, no se puede conectar a la base de datos. Revise la configuración.');
}

$libro = new Libro();
$libro->setIsbn(13546865465321);
$libro->setTitulo('Titulo');
$libro->setAutor('Autor');
$libro->setAnioPublicacion(2022);
$libro->setEjemplaresDisponibles(10);
$libro->setPaginas(100);
var_dump($libro->guardar($pdo));
var_dump($libro->getId());

$libro_r=Libro::rescatar($pdo, $libro->getId());
var_dump($libro_r);

$libro_r->setTitulo('Titulo2');
$libro_r->guardar($pdo);

$libro_r2=Libro::rescatar($pdo, $libro_r->getId());
var_dump($libro_r2);

var_dump(Libros::listarMPC($pdo));

$i_b=libro::borrar($pdo, $libro_r->getId());
var_dump($i_b);

var_dump(Libros::listarMPC($pdo));
