<?php
/* Smarty version 4.0.0, created on 2022-01-10 19:47:47
  from 'C:\htdocs2\DWES04_SOL\templates\default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61dc7f53ee8bb6_12842179',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3fc34c6aba684e58f78600c1fcddc3147fc17dcb' => 
    array (
      0 => 'C:\\htdocs2\\DWES04_SOL\\templates\\default.tpl',
      1 => 1641840317,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61dc7f53ee8bb6_12842179 (Smarty_Internal_Template $_smarty_tpl) {
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
