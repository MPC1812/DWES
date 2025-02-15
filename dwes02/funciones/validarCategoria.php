<!-- Mario Puerma Cortés -->
<?php
//Función para validar si una categoria es válida
function validarCategoria(string $categoria): bool
{
    /*Esta función devuelve true si la categoria es válida, false en caso contrario
    Se utiliza la función array_map para convertir todas las categorias en minúsculas
    Se utiliza la función array_filter para eliminar las categorias vacías
    Se utiliza la función in_array para verificar si la categoria es válida
    Si la categoria es válida, se retorna true, de lo contrario, se retorna false
    he considerado que si seleccionamos "prueba" como categoria, siempre retornará false
    independientemente del resto de categorias
    */
    $categorias = array_map('strtolower', CATEGORIAS);
    $categorias = array_filter($categorias);
    if (
        in_array($categoria, $categorias) && (in_array('prueba', $categorias) !== true)
    ) {
        return true;
    }
    return false;
}
