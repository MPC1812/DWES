<?php
/* Smarty version 4.5.5, created on 2025-03-06 01:27:44
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\dwes04\templates\borrarlibro.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67c8ec0027b0b5_62632817',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5f0f2e4e91d14a9c4d69b87a9d2fcd7f11ce25f5' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\dwes04\\templates\\borrarlibro.tpl',
      1 => 1741220860,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67c8ec0027b0b5_62632817 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Añadir libro</title>
</head>
<style>
    table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    table thead tr {
        background-color: #3e8e41;
        color: #ffffff;
        text-align: left;
    }

    table th,
    table td {
        padding: 12px 15px;
    }
</style>
<form action="/dwes04/index.php?accion=borrar_libro_MPC" method="post">
    <table border="1px solid blue">
        <thead>
            <tr>
                <th>ID</th>
                <th>ISBN</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Año de publicación</th>
                <th>Número de páginas</th>
                <th>Ejemplares disponibles</th>
                <th>Fecha de creación</th>
                <th>Fecha de actualización</th>
            </tr>
        </thead>
        <tbody>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listadolibros']->value, 'libro');
$_smarty_tpl->tpl_vars['libro']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['libro']->value) {
$_smarty_tpl->tpl_vars['libro']->do_else = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getId();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getIsbn();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getTitulo();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getAutor();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getAnioPublicacion();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getPaginas();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getEjemplaresDisponibles();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getFechaCreacion();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getFechaActualizacion();?>
</td>
                    <td>
                        <input type="hidden" value="<?php $_smarty_tpl->_assignInScope('a', $_smarty_tpl->tpl_vars['libro']->value->getId());?>">
                        <button type="submit" name="borrar" class="btn btn-dark btn-sm" value="<?php echo $_smarty_tpl->tpl_vars['a']->value;?>
">Borrar
                        </button>
                    </td>
                </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
    </button>
</form>

</html><?php }
}
