<?php

// Given a string of digits, you should replace any digit below 5 with '0' and any digit 5 and above with '1'. Return the resulting string.

// Note: input will never be an empty string

function fake_bin(string $s): string {
  $bin = '';
  foreach (str_split($s) as $char) {
    if ($char >= '5') {
      
      $bin .='1';
    } else {
      $bin .='0';
    }
  }
  return $bin;
}

//Mejor solución v1
function fake_binv1(string $s): string {
  return strtr($s, '0123456789', '0000011111');
}

//Mejor solución v2
function fake_binv2(string $s): string {
  return preg_replace(array('/[0-4]/', '/[5-9]/'), array('0', '1'), $s);
}


fake_bin('45385593107843568');