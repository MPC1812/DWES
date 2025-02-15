<?php
/* Smarty version 4.0.0, created on 2022-04-06 11:42:50
  from '/mnt/c/htdocs2/DWES04_SOL/templates/addactivores.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_624d609ac30396_95987721',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a7026492f90c4da291995ff5d02a89ac8f91b37' => 
    array (
      0 => '/mnt/c/htdocs2/DWES04_SOL/templates/addactivores.tpl',
      1 => 1642012818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_624d609ac30396_95987721 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['res']->value === -1) {?>
    Error en la base de datos.
<?php } elseif ($_smarty_tpl->tpl_vars['res']->value === false) {?>
    Error en la consulta.
<?php } else { ?>
    Número de registros insertados/modificados es <?php echo $_smarty_tpl->tpl_vars['res']->value;?>
.<br>
    <?php if ((isset($_smarty_tpl->tpl_vars['activo']->value))) {?>
        El identificador autogenerado del activo es: <?php echo $_smarty_tpl->tpl_vars['activo']->value->getId();?>

    <?php }
}?>
<br>
<a href="<?php echo $_smarty_tpl->tpl_vars['rootpath']->value;?>
">Volver</a><?php }
}
