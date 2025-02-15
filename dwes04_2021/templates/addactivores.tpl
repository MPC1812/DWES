{if $res === -1}
    Error en la base de datos.
{elseif $res === false}
    Error en la consulta.
{else}
    Número de registros insertados/modificados es {$res}.<br>
    {if isset($activo)}
        El identificador autogenerado del activo es: {$activo->getId()}
    {/if}
{/if}
<br>
<a href="{$rootpath}">Volver</a>