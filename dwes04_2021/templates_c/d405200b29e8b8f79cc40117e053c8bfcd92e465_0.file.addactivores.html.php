<?php
/* Smarty version 4.0.0, created on 2022-03-02 09:04:10
  from 'C:\htdocs2\DWES04_SOL\templates\addactivores.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_621f24fa8793a4_68460277',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd405200b29e8b8f79cc40117e053c8bfcd92e465' => 
    array (
      0 => 'C:\\htdocs2\\DWES04_SOL\\templates\\addactivores.html',
      1 => 1642012818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_621f24fa8793a4_68460277 (Smarty_Internal_Template $_smarty_tpl) {
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
