<?php
/* Smarty version 4.0.0, created on 2022-01-08 18:46:14
  from 'C:\htdocs2\DWES04_SOL\templates\resultadoop.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61d9cde689b393_13082916',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'daf727d04ec9d93e0870f9dfe6c7676f65159a83' => 
    array (
      0 => 'C:\\htdocs2\\DWES04_SOL\\templates\\resultadoop.html',
      1 => 1641663780,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61d9cde689b393_13082916 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['res']->value === -1) {?>
    Error en la base de datos.
<?php } elseif ($_smarty_tpl->tpl_vars['res']->value === false) {?>
    Error en la consulta.
<?php } else { ?>
    Número de registros insertados <?php echo $_smarty_tpl->tpl_vars['res']->value;?>

<?php }?>
<a href="..">Volver</a><?php }
}
