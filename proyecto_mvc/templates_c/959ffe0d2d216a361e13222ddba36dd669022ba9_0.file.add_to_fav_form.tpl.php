<?php
/* Smarty version 4.3.1, created on 2025-02-09 19:39:06
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\proyecto_mvc\templates\bloques\add_to_fav_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67a8f64ab06aa6_17722460',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '959ffe0d2d216a361e13222ddba36dd669022ba9' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\proyecto_mvc\\templates\\bloques\\add_to_fav_form.tpl',
      1 => 1682003686,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67a8f64ab06aa6_17722460 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="?accion=addtofav" method="post">
    <input type="hidden" name="idprod" value="<?php echo $_smarty_tpl->tpl_vars['idprod']->value;?>
">
    <input type="submit" value="Añadir a favoritos">
</form><?php }
}
