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
        <td>{$impresora->getId()}</td>
        <td>{$impresora->getTipo()}</td>
        <td>{$impresora->getNombre()}</td>
      </tr>
      {/foreach}
      </tbody>
    </table>
    <a href="?accion=crear">
    <input type="button" value="Crear nueva impresora">
    </a>
  </body>
</html>
