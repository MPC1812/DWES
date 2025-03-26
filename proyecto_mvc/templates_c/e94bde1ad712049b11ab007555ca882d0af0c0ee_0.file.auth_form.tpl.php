<?php
/* Smarty version 4.3.1, created on 2025-02-09 19:38:42
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\proyecto_mvc\templates\bloques\auth_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67a8f632ef1987_33423733',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e94bde1ad712049b11ab007555ca882d0af0c0ee' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\proyecto_mvc\\templates\\bloques\\auth_form.tpl',
      1 => 1682003690,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67a8f632ef1987_33423733 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="?accion=autenticar" method="post">
    <label>Usuario:<input type="text" name="username"></label>
    <label>Password:<input type="password" name="password"></label>
    <input type="submit" value="Autenticar">
</form><?php }
}
