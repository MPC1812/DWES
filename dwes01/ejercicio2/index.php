<!-- Mario Puerma Cortés -->
<?php
require_once 'a.php';
require_once 'b.php';

recorrerArray($archivo,$cabecera,$datos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>DWES Tarea01 Sección 2</title>
    <style> table, th, td { border-collapse: collapse; border: 1px solid black; text-align: center;  } th, td { padding: 5px; } </style>
</head>
<body>
    <table>
        
            <tr> 
                    <?php for($i=0;$i<count($cabecera);$i++){
                    echo '<th>'.$cabecera[$i].'</th>';
                    }?>
            </tr>
            <?php foreach ($datos as $fila): ?>
            <tr> 
                <td><?=$fila['nombre'];?></td>
                <td><?=$fila['PVD'];?></td>
                <td><?=$fila['PVP'];?></td>
                <td><?=$fila['codigo'];?></td>
                <td><?=$fila['familia'];?></td>
            </tr>
        <?php endforeach; ?>    
       
    </table>
<h1>Datos de productos con PVP mayor a 359€</h1>
    <table>
        
        <tr> 
                <?php for($i=0;$i<count($cabecera);$i++){
                echo '<th>'.$cabecera[$i].'</th>';
                }?>
        </tr>
        <?php foreach ($datos as $fila): ?>
        <?php if ($fila['PVP']>='359'):?>  
            <tr> 
                <td><?=$fila['nombre'];?></td>
                <td><?=$fila['PVD'];?></td>
                <td><?=$fila['PVP'];?></td>
                <td><?=$fila['codigo'];?></td>
                <td><?=$fila['familia'];?></td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>   
   
</table>

<h1>Datos de productos que pertenecen a la familia monitores</h1>
    <table>
        
        <tr> 
                <?php for($i=0;$i<count($cabecera);$i++){
                echo '<th>'.$cabecera[$i].'</th>';
                }?>
        </tr>
        <?php foreach ($datos as $fila): ?>
        <?php if ($fila['familia']==='monitores'):?>  
            <tr> 
                <td><?=$fila['nombre'];?></td>
                <td><?=$fila['PVD'];?></td>
                <td><?=$fila['PVP'];?></td>
                <td><?=$fila['codigo'];?></td>
                <td><?=$fila['familia'];?></td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>   
   
</table>
</body>
</html>