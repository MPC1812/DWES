<?php
use DWES04\Peticion;
use DWES04\Activo;

/**
 * Controlador que gestiona la operacion "addactivo". 
 * @param Peticion $p Instancia de la clase Peticion.
 * @param Smarty $s Instancia de la clase Smarty.
 * @param PDO $c Instancia válida de la clase PDO con una conexión activa.
 */
function controladorAddActivo(Peticion $p, Smarty $s, PDO $c)
{
    $a=new Activo();    
    $s->assign('rootpath',ROOTPATH);
    if ($p->isPost() & $p->has('nombre','descripcion','empresamnt','contactomnt','telefonomnt'))
    {
        $a->setNombre($p->getString('nombre'));    
        $a->setDescripcion($p->getString('descripcion'));
        $a->setEmpresamnt($p->getString('empresamnt'));
        $a->setContactomnt($p->getString('contactomnt'));
        $a->setTelefonomnt($p->getString('telefonomnt'));
        $errors=$a->checkCoherence();    
        $s->assign('activo',$a);        
        if ($errors)
        {
            $s->assign('errors',$errors);           
            $s->display('addactivoform.tpl');        
        }
        else
        {
            $s->assign('res',$a->guardar($c));   
            $s->display('addactivores.tpl');
        }
    }
    else
    {
        $s->assign('activo',$a);    
        $s->display('addactivoform.tpl');
    }
}

/**
 * Controlador encargado de la operacion "editaactivo".
 * Básicamente, muestra los datos de un activo existente y permite su modificación.
 * @param Peticion $p Instancia de la clase Peticion.
 * @param Smarty $s Instancia de la clase Smarty.
 * @param PDO $c Instancia válida de la clase PDO con una conexión activa.
 */
function controladorEditarActivo(Peticion $p, Smarty $s, PDO $c)
{
    $s->assign('rootpath',ROOTPATH);
    if (!$p->isPost() || !$p->has('idactivo'))
    {
        $resultado='Petición incorrecta.'; 
    }
    else
    {
        try{
            $a=Activo::rescatar($c,$p->getInt('idactivo'));
            if (!($a instanceof Activo))
            {
                $resultado='Error al rescatar el activo de la base de datos.';
            }
        } 
        catch (Exception $e)
        {
            $resultado='Error en parámetros.';
        }
    }

    if (isset($resultado))
    {
        $s->assign('resultado',$resultado);
        $s->assign('rootpath',ROOTPATH);    
        $s->display('resultado.tpl');
        return;
    }

    if ($p->isPost() & $p->has('nombre','descripcion','empresamnt','contactomnt','telefonomnt'))
    {
        $a->setNombre($p->getString('nombre'));    
        $a->setDescripcion($p->getString('descripcion'));
        $a->setEmpresamnt($p->getString('empresamnt'));
        $a->setContactomnt($p->getString('contactomnt'));
        $a->setTelefonomnt($p->getString('telefonomnt'));
        $errors=$a->checkCoherence();        
        if ($errors)
        {
            $s->assign('errors',$errors);
            $s->assign('activo',$a);    
            $s->display('editactivoform.tpl');        
        }
        else
        {
            $s->assign('res',$a->guardar($c));   
            $s->display('addactivores.tpl');
        }
    }
    else
    {
        $s->assign('activo',$a);    
        $s->display('editactivoform.tpl');
    }
}

/**
 * Controlador encargado de listar los activos almacenados en la base de datos (operacion 'listaractivos').
 * @param Peticion $p Instancia de la clase Peticion.
 * @param Smarty $s Instancia de la clase Smarty.
 * @param PDO $c Instancia válida de la clase PDO con una conexión activa.
 */
function controladorListarActivos(Peticion $p, Smarty $s, PDO $c)
{
    $listaActivos=Activo::getAllActivos($c);
    $s->assign('activos',$listaActivos);
    $s->assign('rootpath',ROOTPATH);
    $s->display('listactivos.tpl');
}

/**
 * Controlador encargado de la operacion "borraractivo".
 * @param Peticion $p Instancia de la clase Peticion.
 * @param Smarty $s Instancia de la clase Smarty.
 * @param PDO $c Instancia válida de la clase PDO con una conexión activa.
 */
function controladorBorrarActivo(Peticion $p, Smarty $s, PDO $c)
{
    $resultado='Petición incorrecta.';
    if ($p->isPost())
    {       
         
        try {
            $idactivo=$p->getInt('idactivo');
            $r=Activo::borrar($c,$idactivo);
            if ($r===false)
            {
                $resultado='Error en consulta.';
            }
            elseif ($r===-1)
            {
                $resullado='Error en base de datos.';
            }   
            else
            {
                $resultado='Se han eliminado '.$r.' filas';
            }
        } 
        catch (Exception $e)
        {
            $resultado='Error al obtener el ID del activo a eliminar.';
        }
    }
    $s->assign('resultado',$resultado);
    $s->assign('rootpath',ROOTPATH);    
    $s->display('resultado.tpl');
}

/**
 * Controlador por defecto
 * @param Peticion $p Instancia de la clase Peticion.
 * @param Smarty $s Instancia de la clase Smarty.
 * @param string $ruta Ruta solicitada en la petición http.
 */
function controladorDefecto(Peticion $p, Smarty $s, $ruta)
{
    if ($ruta!=='' && $ruta!='/') $s->assign('rutanoexistente',$ruta);
    $s->assign('rootpath',ROOTPATH);
    $s->display('default.tpl');
}