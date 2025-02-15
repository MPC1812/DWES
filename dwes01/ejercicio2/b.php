<!-- Mario Puerma Cortés -->
<?php
//función para recorrer los archivos CSV
function recorrerArray(&$archivo,&$cabecera,&$datos){
        for($numero=1;$numero<10;$numero++){
                $existe='datos'.$numero.'.csv';
                if (file_exists($existe)){
                        $archivo=fopen($existe,'r');
                        leerCSV($archivo,$cabecera,$datos);
                }
        }
}