<?php
/* Smarty version 4.3.1, created on 2025-02-09 19:39:17
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\proyecto_mvc\templates\add_to_fav_result.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.1',
  'unifunc' => 'content_67a8f655518150_81673990',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa8f7926139172a3fbd7b53a9ff9dd6da81885a9' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\proyecto_mvc\\templates\\add_to_fav_result.tpl',
      1 => 1682007509,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_67a8f655518150_81673990 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>"Resultado de añadir a favoritos"), 0, false);
echo $_smarty_tpl->tpl_vars['resultado']->value;?>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
