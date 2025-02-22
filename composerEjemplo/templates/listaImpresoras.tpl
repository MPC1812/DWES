<!DOCTYPE html>
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
      {foreach $listadoImpresoras as $impresora}
      <tr>
        <td>{$impresora.id}</td>
        <td>{$impresora.tipo}</td>
        <td>{$impresora.nombre}</td>
      </tr>
      {/foreach}
      </tbody>
    </table>
  </body>
</html>
