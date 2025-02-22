<?php
/* Smarty version 4.5.5, created on 2025-02-22 13:46:54
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\composerEjemplo\templates\listaImpresoras.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67b9c73eb123d2_94608245',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16afc50210647e8b22ac7639965f1abc12a6e224' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\composerEjemplo\\templates\\listaImpresoras.tpl',
      1 => 1740228411,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67b9c73eb123d2_94608245 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=100%, initial-scale=1.0" />
    <title>Composer, lista de impresoras</title>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
          <th>Nombre</th>
        </tr>
      </thead>
      <tbody>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listadoImpresoras']->value, 'impresora');
$_smarty_tpl->tpl_vars['impresora']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['impresora']->value) {
$_smarty_tpl->tpl_vars['impresora']->do_else = false;
?>
      <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['impresora']->value['id'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['impresora']->value['tipo'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['impresora']->value['nombre'];?>
</td>
      </tr>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </body>
</html>
<?php }
}
