<!-- Mario Puerma Cortés -->
<?php
/*Esta pequeña función valida si el usuario ha seleccionado las propiedades correctas, si selecciona prueba, no se valida
aunque haya seleccionado alguna propiedad, porque no se puede seleccionar la propiedad prueba
*/

function validarPropiedades(array $propiedades): bool
{
    $propiedades = array_map('strtolower', $propiedades);
    $propiedades = array_filter($propiedades);
    if ((in_array('sin gluten', $propiedades) || in_array('sin lactosa', $propiedades) || in_array('vegano', $propiedades) 
    || in_array('orgánico', $propiedades) || in_array('sin conservantes', $propiedades) || in_array('sin colorantes', $propiedades))
 && (in_array('prueba', $propiedades)!==true)) {
        return true;
    }
    return false;
}
