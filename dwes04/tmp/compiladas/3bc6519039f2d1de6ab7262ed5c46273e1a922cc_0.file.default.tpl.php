<?php
/* Smarty version 4.5.5, created on 2025-03-03 11:55:38
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\dwes04\templates\default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67c58aaadc5b14_49054303',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3bc6519039f2d1de6ab7262ed5c46273e1a922cc' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\dwes04\\templates\\default.tpl',
      1 => 1740999046,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67c58aaadc5b14_49054303 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Página principal</title>
</head>

<body>
    <?php if ((isset($_smarty_tpl->tpl_vars['rutanoexistente']->value))) {?>
        <P>ERROR: la ruta <?php echo $_smarty_tpl->tpl_vars['rutanoexistente']->value;?>
 no existe</P>
    <?php }?>
    <H1>Acciones</H1>
    <p><a href='/dwes04/addlibro'><input type="button" value="Añadir libro"></a>
    <a href='/dwes04/borrarlibro'><input type="button" value="Borrar Libro"></a>
    <a href='/dwes04/mostrarlibros'><input type="button" value="Mostrar Libros"></a></p>
    </body>

</html><?php }
}
