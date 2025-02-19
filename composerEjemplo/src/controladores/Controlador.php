<?php

namespace TEST\controladores;

use TEST\helper;

class Controlador
{

    public static function mostrarNumeroAlAzar(\Smarty $smarty)
    {
        
        $smarty->assign('numeroAlAzar', helper::randomNumber());
        $smarty->display('lista.tpl');
        //var_dump(TEST\modelo\Impresora::obtenerImpresoras($pdo));
    }
}
