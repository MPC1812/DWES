<?php
/* Smarty version 4.0.0, created on 2022-03-17 09:06:07
  from '/mnt/c/htdocs2/DWES04_SOL/templates/addactivores.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_6232ebef40c547_20904355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '810aa09a64cbd52433504c7ccec413e7c30e316f' => 
    array (
      0 => '/mnt/c/htdocs2/DWES04_SOL/templates/addactivores.html',
      1 => 1642012818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6232ebef40c547_20904355 (Smarty_Internal_Template $_smarty_tpl) {
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
