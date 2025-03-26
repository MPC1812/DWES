<?php

namespace TEST\controladores;

use TEST\helper;
use TEST\modelo\Impresora;
use TEST\modelo\Impresoras;

class Controlador
{

    public static function mostrarNumeroAlAzar(\Smarty $smarty)
    {

        $smarty->assign('numeroAlAzar', helper::randomNumber());
        $smarty->display('lista.tpl');
        //var_dump(TEST\modelo\Impresora::obtenerImpresoras($pdo));
    }

    public static function mostrarImpresoras(\Smarty $smarty, \PDO $pdo)
    {
        $listadoImpresoras = Impresoras::obtenerImpresoras($pdo);
        $smarty->assign('listadoImpresoras', $listadoImpresoras);
        $smarty->display('listaImpresoras.tpl');
    }

    public static function formCrearImpresora(\Smarty $smarty)
    {
        $smarty->display('formnuevaimpresora.tpl');
    }

    public static function crearImpresora(\Smarty $smarty, \PDO $pdo)
    {
        $impresora = new Impresora();
        $error = false;
        if (isset($_POST['nombre']))
            $impresora->setNombre($_POST['nombre']);
        else
            $error = true;
        if (isset($_POST['tipo']) && in_array($_POST['tipo'], Impresora::TIPOS))
            $impresora->setTipo($_POST['tipo']);
        else $error = true;
        if (!$error) {
            if ($errc=$impresora->guardar($pdo)===true) {
                $mensaje = "Se ha insertado una nueva impresora con id " . $impresora->getId();
            } else {
                $mensaje = "La operación retornó un error: " . $errc;
            }
        } else {
            $mensaje = "Error en los datos recibidos";
        }
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('mensaje.tpl');
    }
}
