<?php

namespace DWES04\controladores;

use DWES04\Peticion as Peticion;
use DWES04\modelo\Libro;
use DWES04\modelo\Libros;

class ControladorMPC
{
    public static function mostrarLibros(Peticion $p, \Smarty $smarty, \PDO $pdo)
    {
        if ($p->has('ordenar') == true) {
            $ordenar = $p->getString('ordenar');
        } else {
            $ordenar = 'SORT_DESC';
        }
        $smarty->display('barra.tpl');
        $listadolibros = Libros::listarMPC($pdo);
        var_dump($listadolibros);
        $smarty->assign('listadolibros', $listadolibros);
        $smarty->assign('rootpath', ROOTPATH . 'mostrarLibros');
        $smarty->display('mostrarLibros.tpl');
    }

    public static function borrarLibro(Peticion $p, \Smarty $smarty, \PDO $pdo) {
        $smarty->display('barra.tpl');
        $listadolibros = Libros::listarMPC($pdo);
        $smarty->assign('listadolibros', $listadolibros);
        $smarty->assign('rootpath', ROOTPATH . 'borrarlibro');
        $smarty->display('borrarlibro.tpl');
        if ($p->has('id') == false) return;
        libro::borrar($pdo, $p->getString('id'));
    }

    public static function guardarLibro(Peticion $p, \Smarty $smarty, \PDO $pdo)
    {
        $smarty->display('barra.tpl');
        $listadolibros = Libros::listarMPC($pdo);
        $smarty->assign('listadolibros', $listadolibros);
        $smarty->assign('rootpath', ROOTPATH . 'addlibro');
        $smarty->display('addlibro.tpl');
        if ($p->has('isbn') == true && $p->has('titulo') == true && $p->has('autor') == true &&$p->has('anio') == true
        && $p->has('ejemplares') == true && $p->has('paginas') == true) {
            if ($p->has('id') == false || $p->getString('id') == '' || ($p->getString('id') == null || !in_array($p->getString('id'),$listadolibros))) {
                $libro = new Libro();
                $libro->setIsbn($p->getString('isbn'));
                $libro->setTitulo($p->getString('titulo'));
                $libro->setAutor($p->getString('autor'));
                $libro->setAnioPublicacion($p->getString('anio'));
                $libro->setEjemplaresDisponibles($p->getString('ejemplares'));
                $libro->setPaginas($p->getString('paginas'));
                $libro->guardar($pdo);
            } else {
                $librom = Libro::rescatar($pdo, $p->getString('id'));
                $librom->setIsbn($p->getString('isbn'));
                $librom->setTitulo($p->getString('titulo'));
                $librom->setAutor($p->getString('autor'));
                $librom->setAnioPublicacion($p->getString('anio'));
                $librom->setEjemplaresDisponibles($p->getString('ejemplares'));
                $librom->setPaginas($p->getString('paginas'));
                $librom->guardar($pdo);
            }
        }
    }

    public static function controladorDefecto(Peticion $p, \Smarty $smarty, $ruta)
    {
        if ($ruta !== '' && $ruta != '/') $smarty->assign('rutanoexistente', $ruta);
        //$smarty->assign('rootpath', ROOTPATH.'index.php');
        $smarty->display('default.tpl');
    }
}
