<?php
/* Smarty version 4.5.5, created on 2025-03-02 04:23:05
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\dwes04\templates\addlibro.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67c3cf19c7ac74_47861525',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a45485402790b5790487508d5a87013feb4ce03' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\dwes04\\templates\\addlibro.tpl',
      1 => 1740885781,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67c3cf19c7ac74_47861525 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Añadir/Modificar libro</title>
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
    form {
    margin-top: 1em;
    }
</style>
<form action="/addlibro" method="post">
<input type="text" name="id" placeholder="ID Sólo para modificar">	
<input type="text" name="isbn" placeholder="ISBN" required>
<input type="text" name="titulo" placeholder="Título" required>
<input type="text" name="autor" placeholder="Autor" required>
<input type="text" name="anio" placeholder="Año de publicación" required>
<input type="text" name="paginas" placeholder="Número de páginas" required>
<input type="text" name="ejemplares" placeholder="Ejemplares disponibles" required>
<button type="submit" name="addlibro" class="btn btn-dark btn-sm">AÑADIR/MODIFICAR</button>
</form>
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
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<a href='/index.php'><button type="submit" name="home" class="btn btn-dark btn-sm" method="post">PÁGINA PRINCIPAL</button></a><?php }
}
