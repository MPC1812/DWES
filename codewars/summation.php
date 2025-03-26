<?php
function summation(int $n): int {
    $sum = 0;
  for ($i=1; $i<=$n; $i++) {
    $sum+=$i;
  }
  return $sum;
}

//Mejor solución
function summationBest($n) {
    return array_sum(range(1, $n));
  }