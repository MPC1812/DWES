<?php
/* Smarty version 4.0.0, created on 2022-03-17 09:05:31
  from '/mnt/c/htdocs2/DWES04_SOL/templates/default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_6232ebcbe72165_27130939',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3ab31a0b80cf5394eb4b48c1b323989c2f78fb6' => 
    array (
      0 => '/mnt/c/htdocs2/DWES04_SOL/templates/default.tpl',
      1 => 1646989728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6232ebcbe72165_27130939 (Smarty_Internal_Template $_smarty_tpl) {
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
