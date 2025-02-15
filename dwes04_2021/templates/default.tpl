<!DOCTYPE html>
<HTML>
    <HEAD>
        <title>
            Página principal.
        </title>
    </HEAD>
    <body>        
        {if isset($rutanoexistente)}
            <P>ERROR: la ruta {$rutanoexistente} no existe</P>
        {/if}
        <H1>Acciones</H1>
        <P><A href='{$rootpath}/addactivo'>Añadir un activo.</a></P>
        <P><A href='{$rootpath}/listaractivos'>Listar activos.</a></P>
    </body>
    
</HTML>