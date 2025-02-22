<?php

namespace TEST\controladores;

use TEST\helper;
use TEST\modelo\Impresora;

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
        $listadoImpresoras=Impresora::obtenerImpresoras($pdo);
        $smarty->assign('listadoImpresoras', $listadoImpresoras);
        $smarty->display('listaImpresoras.tpl');
    }
}
