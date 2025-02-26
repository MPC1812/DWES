<?php
/* Smarty version 4.5.5, created on 2025-02-24 17:54:59
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\composerEjemplo\templates\formnuevaimpresora.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67bca463c15991_92000481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '430a247c62090ae7e82995f59ef6f52a84225fa8' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\composerEjemplo\\templates\\formnuevaimpresora.tpl',
      1 => 1740416087,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67bca463c15991_92000481 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Nueva Impresora</title>
</head>
<body>
    <form action="index.php?accion=guardar" method="post">
        Tipo: <input type="text" name="tipo"><br>
        Nombre: <input type="text" name="nombre"><br>
        <input type="submit" value="Crear">
    </form>
</body>
</html><?php }
}
