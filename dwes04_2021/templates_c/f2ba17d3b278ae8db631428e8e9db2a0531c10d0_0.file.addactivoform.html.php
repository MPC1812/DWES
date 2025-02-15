<?php
/* Smarty version 4.0.0, created on 2022-03-17 09:05:33
  from '/mnt/c/htdocs2/DWES04_SOL/templates/addactivoform.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_6232ebcd635f86_17937403',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f2ba17d3b278ae8db631428e8e9db2a0531c10d0' => 
    array (
      0 => '/mnt/c/htdocs2/DWES04_SOL/templates/addactivoform.html',
      1 => 1641665276,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6232ebcd635f86_17937403 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['errors']->value)) && count($_smarty_tpl->tpl_vars['errors']->value) > 0) {?>   
<H2>Errores:</H2>
<UL>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
<LI><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</LI>       
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</UL>
<?php }?>

<form action="" method="post">
    <label>Nombre del activo:
        <input type="text" name="nombre" value="<?php echo $_smarty_tpl->tpl_vars['activo']->value->getNombre();?>
">
    </label><br>
    <label>Descripción del activo:
        <input type="text" name="descripcion" value="<?php echo $_smarty_tpl->tpl_vars['activo']->value->getDescripcion();?>
">
    </label><br>
    <label>Empresa de mantenimiento:
        <input type="text" name="empresamnt" value="<?php echo $_smarty_tpl->tpl_vars['activo']->value->getEmpresamnt();?>
">
    </label><br>
    <label>Persona de mantenimiento:
        <input type="text" name="contactomnt" value="<?php echo $_smarty_tpl->tpl_vars['activo']->value->getContactomnt();?>
">
    </label><br>
    <label>Teléfono contacto:
        <input type="text" name="telefonomnt" value="<?php echo $_smarty_tpl->tpl_vars['activo']->value->getTelefonomnt();?>
">
    </label><br>
    <input type="submit" value="¡Enviar!">
</form>
<a href="<?php echo $_smarty_tpl->tpl_vars['rootpath']->value;?>
">Volver</a><?php }
}
