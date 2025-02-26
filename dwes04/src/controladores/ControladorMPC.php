<?php

namespace DWES04\controladores;

use DWES04\Peticion as Peticion;
use DWES04\modelo\Libro;
use DWES04\modelo\Libros;

class ControladorMPC
{
    public static function mostrarLibros(\Smarty $smarty, \PDO $pdo)
    {
        $listadolibros = Libros::listarMPC($pdo);
        $smarty->assign('listadolibros', $listadolibros);
        $smarty->assign('rootpath', ROOTPATH . 'mostrarLibros');
        $smarty->display('mostrarLibros.tpl');
    }

    public static function crearLibro(Peticion $p, \Smarty $smarty, \PDO $pdo) {}

    public static function borrarLibro(Peticion $p, \Smarty $smarty, \PDO $pdo) {
        $listadolibros = Libros::listarMPC($pdo);
        $smarty->assign('listadolibros', $listadolibros);
        $smarty->assign('rootpath', ROOTPATH . 'borrarlibro');
        $smarty->display('borrarlibro.tpl');
        if ($p->has('id') == false) return;
        libro::borrar($pdo, $p->getString('id'));
    }

    public static function guardarLibro(Peticion $p, \Smarty $smarty, \PDO $pdo)
    {
        $listadolibros = Libros::listarMPC($pdo);
        $smarty->assign('listadolibros', $listadolibros);
        $smarty->assign('rootpath', ROOTPATH . 'addlibro');
        $smarty->display('addlibro.tpl');
        if ($p->has('isbn') == false) return;
        $libro = new Libro();
        $libro->setIsbn($p->getString('isbn'));
        $libro->setTitulo($p->getString('titulo'));
        $libro->setAutor($p->getString('autor'));
        $libro->setAnioPublicacion($p->getString('anio'));
        $libro->setEjemplaresDisponibles($p->getString('ejemplares'));
        $libro->setPaginas($p->getString('paginas'));
        var_dump($libro->guardar($pdo));
        var_dump($libro->getId());
    }

    public static function controladorDefecto(Peticion $p, \Smarty $smarty, $ruta)
    {
        if ($ruta !== '' && $ruta != '/') $smarty->assign('rutanoexistente', $ruta);
        $smarty->assign('rootpath', ROOTPATH.'index.php');
        $smarty->display('default.tpl');
    }
}
