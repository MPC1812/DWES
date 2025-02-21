<?php

// Your task is to make a function that can take any non-negative integer as an argument and return it with its digits in descending order. 
//Essentially, rearrange the digits to create the highest possible number.

// Examples:
// Input: 42145 Output: 54421

// Input: 145263 Output: 654321

// Input: 123456789 Output: 987654321

function descendingOrderv1 (int $numero)

{
    $strnumero = (string)$numero;
    for ($i = 0; $i < strlen($strnumero); $i++) {
$numeros[] = $strnumero[$i];
    }
    array_multisort($numeros, SORT_DESC);
    $strnumero = implode($numeros);
  $numero =(int)$strnumero;
    return $numero;

}

//Mejor solución
function descendingOrder(int $n): int {
    $arrayNumber = str_split($n);
    arsort($arrayNumber);
    return (int)  implode($arrayNumber);
  }

echo descendingOrderv1(9123456789);
