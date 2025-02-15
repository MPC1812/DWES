<?php
/* Smarty version 4.0.0, created on 2022-04-06 12:01:55
  from '/mnt/c/htdocs2/DWES04_SOLucion/templates/default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_624d6513a27747_31959441',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21e79e6a6207dadff81a917abc649c9d7ed3c692' => 
    array (
      0 => '/mnt/c/htdocs2/DWES04_SOLucion/templates/default.tpl',
      1 => 1646989728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_624d6513a27747_31959441 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<HTML>
    <HEAD>
        <title>
            Página principal.
        </title>
    </HEAD>
    <body>        
        <?php if ((isset($_smarty_tpl->tpl_vars['rutanoexistente']->value))) {?>
            <P>ERROR: la ruta <?php echo $_smarty_tpl->tpl_vars['rutanoexistente']->value;?>
 no existe</P>
        <?php }?>
        <H1>Acciones</H1>
        <P><A href='<?php echo $_smarty_tpl->tpl_vars['rootpath']->value;?>
/addactivo'>Añadir un activo.</a></P>
        <P><A href='<?php echo $_smarty_tpl->tpl_vars['rootpath']->value;?>
/listaractivos'>Listar activos.</a></P>
    </body>
    
</HTML><?php }
}
