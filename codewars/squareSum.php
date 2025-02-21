<?php
  
function square_sum(array $numbers) : int {
  $result = 0;
  foreach ($numbers as $number) {
    $result += $number*$number;
  }
  return $result;
}

echo square_sum([1,2]);