{if isset($errors) && count($errors)>0}   
<H2>Errores:</H2>
<UL>
{foreach $errors as $error}
<LI>{$error}</LI>       
{/foreach}
</UL>
{/if}

<form action="" method="post">
    <label>Nombre del activo:
        <input type="text" name="nombre" value="{$activo->getNombre()}">
    </label><br>
    <label>Descripción del activo:
        <input type="text" name="descripcion" value="{$activo->getDescripcion()}">
    </label><br>
    <label>Empresa de mantenimiento:
        <input type="text" name="empresamnt" value="{$activo->getEmpresamnt()}">
    </label><br>
    <label>Persona de mantenimiento:
        <input type="text" name="contactomnt" value="{$activo->getContactomnt()}">
    </label><br>
    <label>Teléfono contacto:
        <input type="text" name="telefonomnt" value="{$activo->getTelefonomnt()}">
    </label><br>
    <input type="submit" value="¡Enviar!">
</form>
<a href="{$rootpath}">Volver</a>