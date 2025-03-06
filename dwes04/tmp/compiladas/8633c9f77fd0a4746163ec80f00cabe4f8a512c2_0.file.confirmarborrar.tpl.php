<?php
/* Smarty version 4.5.5, created on 2025-03-06 02:40:58
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\dwes04\templates\confirmarborrar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67c8fd2a34a933_70901120',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8633c9f77fd0a4746163ec80f00cabe4f8a512c2' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\dwes04\\templates\\confirmarborrar.tpl',
      1 => 1741225253,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67c8fd2a34a933_70901120 (Smarty_Internal_Template $_smarty_tpl) {
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
<input type="checkbox" name="checkboxborrar" value="checkboxborrar">
<button type="submit" name="accion" class="btn btn-dark btn-sm" value="confirmar">
<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['idborrar']->value;?>
" name="borrar">
<input type="hidden" value="TEST" name="control">
¿Está seguro de que desea borrar el libro?
</button>
</form>
    </form>
    </html><?php }
}
