<?php
// Given a random non-negative number, you have to return the digits of this number within an array in reverse order.

// Example (Input => Output):
// 35231 => [1,3,2,5,3]
// 0     => [0]

function digitize(int $n): array{
  $strnum = str_split($n);
  return array_reverse(array_map('intval', $strnum));
}

//Mejor solución
function digitizeBest(int $n): array {
    return array_map('intval', str_split(strrev($n)));
  }