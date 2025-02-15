<?php
/* Smarty version 4.0.0, created on 2022-04-06 12:02:43
  from '/mnt/c/htdocs2/DWES04_SOLucion_2021-2022/templates/default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_624d6543a78219_54825578',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ef60ee05ab1c1e0f9460b34ca2ddc309d7ed043' => 
    array (
      0 => '/mnt/c/htdocs2/DWES04_SOLucion_2021-2022/templates/default.tpl',
      1 => 1646989728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_624d6543a78219_54825578 (Smarty_Internal_Template $_smarty_tpl) {
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
