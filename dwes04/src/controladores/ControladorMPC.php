<?php

namespace DWES04\controladores;

use DWES04\Peticion as Peticion;
use DWES04\modelo\Libro;
use DWES04\modelo\Libros;

/**
 * Clase ControladorMPC.
 * Contiene los métodos de la clase ControladorMPC. Permite operar con los libros almacenados en la base de datos.
 * @package DWES04\controladores
 * @author Mario Puerma Cortés
 */
class ControladorMPC
{
    /** Controlador encargado de la operación "mostrarLibros".
     * Muestra la lista de libros almacenados en la base de datos.
     * @param Peticion $p Instancia de la clase Peticion.
     * @param \Smarty $smarty Instancia de la clase Smarty.
     * @param \PDO $pdo Instancia válida de la clase PDO con una conexión activa.
     */
    public static function mostrarLibros(Peticion $p, \Smarty $smarty, \PDO $pdo)
    {
        if ($p->has('ordenar') && $p->getString('ordenar') == 'true') {
            $ordenar = true;
        } elseif ($p->has('ordenar') && $p->getString('ordenar') == 'false') {
            $ordenar = false;
        } else {
            if ($p->getMethod() === 'GET') {
                $ordenar = true;
            } else {
                $ordenar = false;
            }
        }
        $smarty->display('barra.tpl');
        $listadolibros = Libros::listarMPC($pdo, $ordenar);
        $smarty->assign('listadolibros', $listadolibros);
        if ($p->has('accion') && $p->getString('accion') === 'nuevo_libro_form_MPC') {
        } elseif ($p->has('accion') && $p->getString('accion') === 'borrar_libro_MPC') {
            $smarty->display('borrarlibro.tpl');
            if ($p->has('id') && $p->getString('id') != '') {
                $smarty->display('confirmarborrar.tpl');
            }
        } else {
            $smarty->display('mostrarLibros.tpl');
        }
    }

    /** Controlador encargado de la operación "borrarLibro".
     * Permite borrar un libro de la base de datos.
     * @param Peticion $p Instancia de la clase Peticion.
     * @param \Smarty $smarty Instancia de la clase Smarty.
     * @param \PDO $pdo Instancia válida de la clase PDO con una conexión activa.
     */
    public static function borrarLibro(Peticion $p, \Smarty $smarty, \PDO $pdo)
    {
        if ($p->has('id') == false) return;
        if ($p->has('id') && $p->has('checkboxborrar')) {
            libro::borrar($pdo, $p->getString('id'));
        }
    }

    /** Controlador encargado de la operación "formlibro".
     * Muestra el formulario para la inserción de un nuevo libro.
     * @param Smarty $smarty Instancia de la clase Smarty.
     */
    public static function formlibro(\Smarty $smarty)
    {
        $smarty->display('formlibro.tpl');
    }

    public static function guardarLibro(Peticion $p, \Smarty $smarty, \PDO $pdo)
    {
        $validar = false;
        $mensaje = "";
        if ($p->has('isbn') && $p->getString('isbn') != '' && $p->getString('isbn') != null && is_numeric($p->getString('isbn'))) {
            $validar = true;
        } else {
            $mensaje .= "El campo ISBN no puede estar vacío, no debe ser nulo y debe ser un número <br>";
            $validar = false;
        }
        if ($p->has('titulo') && $p->getString('titulo') != '' && $p->getString('titulo') != null) {
            $validar = true;
        } else {
            $mensaje .= "El campo Título no puede estar vacío, no debe ser nulo <br>";
            $validar = false;
        }
        if ($p->has('autor') && $p->getString('autor') != '' && $p->getString('autor') != null) {
            $validar = true;
        } else {
            $mensaje .= "El campo Autor no puede estar vacío, no debe ser nulo <br>";
            $validar = false;
        }
        if ($p->has('anio') && $p->getString('anio') != '' && $p->getString('anio') != null && is_numeric($p->getString('anio'))) {
            $validar = true;
        } else {
            $mensaje .= "El campo Año de publicación no puede estar vacío, no debe ser nulo y debe ser un número <br>";
            $validar = false;
        }
        if ($p->has('paginas') && $p->getString('paginas') != '' && $p->getString('paginas') != null && is_numeric($p->getString('paginas'))) {
            $validar = true;
        } else {
            $mensaje .= "El campo Número de páginas no puede estar vacío, no debe ser nulo y debe ser un número <br>";
            $validar = false;
        }
        if ($p->has('ejemplares') && $p->getString('ejemplares') != '' && $p->getString('ejemplares') != null && is_numeric($p->getString('ejemplares'))) {
            $validar = true;
        } else {
            $mensaje .= "El campo Ejemplares disponibles no puede estar vacío, no debe ser nulo y debe ser un número <br>";
            $validar = false;
        }

        if ($validar) {

            $libro = new Libro();
            $libro->setIsbn($p->getString('isbn'));
            $libro->setTitulo($p->getString('titulo'));
            $libro->setAutor($p->getString('autor'));
            $libro->setAnioPublicacion($p->getString('anio'));
            $libro->setEjemplaresDisponibles($p->getString('ejemplares'));
            $libro->setPaginas($p->getString('paginas'));
            $libro->guardar($pdo);
            $mensaje = "Se ha insertado un nuevo libro con id " . $libro->getId();
        } else {
            $mensaje .= "<br>NO SE HA PODIDO GUARDAR EL LIBRO";
        }
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('mensaje.tpl');
    }

    /** Controlador por defecto.
     * Muestra la página de inicio.
     * @param Peticion $p Instancia de la clase Peticion.
     * @param \Smarty $smarty Instancia de la clase Smarty.
     * @param string $ruta Ruta solicitada en la petición http.
     * @param \PDO $pdo Instancia válida de la clase PDO con una conexión activa.
     */
    public static function controladorDefecto(Peticion $p, \Smarty $smarty, $ruta, \PDO $pdo)
    {
        if ($ruta !== '' && $ruta != '/') $smarty->assign('rutanoexistente', $ruta);
        $smarty->display('default.tpl');
        if ($p->has('ordenar') && $p->getString('ordenar') == 'true') {
            $ordenar = true;
        } elseif ($p->has('ordenar') && $p->getString('ordenar') == 'false') {
            $ordenar = false;
        } else {
            if ($p->getMethod() === 'GET') {
                $ordenar = true;
            } else {
                $ordenar = false;
            }
        }
        $listadolibros = Libros::listarMPC($pdo, $ordenar);
        $smarty->assign('listadolibros', $listadolibros);
        $smarty->display('mostrarLibros.tpl');
    }
}
