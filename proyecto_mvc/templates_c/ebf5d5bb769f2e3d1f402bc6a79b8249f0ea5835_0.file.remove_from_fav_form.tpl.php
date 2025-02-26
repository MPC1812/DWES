<?php
/* Smarty version 4.3.1, created on 2025-02-09 19:39:21
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\proyecto_mvc\templates\bloques\remove_from_fav_form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67a8f6595b88d6_85292876',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ebf5d5bb769f2e3d1f402bc6a79b8249f0ea5835' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\proyecto_mvc\\templates\\bloques\\remove_from_fav_form.tpl',
      1 => 1682005892,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67a8f6595b88d6_85292876 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="?accion=removefromfav" method="post">
    <input type="hidden" name="idprod" value="<?php echo $_smarty_tpl->tpl_vars['idprod']->value;?>
">
    <input type="submit" value="Borrar de favoritos">
</form><?php }
}
