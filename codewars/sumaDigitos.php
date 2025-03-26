<?php
// Digital root is the recursive sum of all the digits in a number.

// Given n, take the sum of the digits of n. If that value has more than one digit, continue reducing in this way until a single-digit number is produced. The input will be a non-negative integer.

// Examples
//     16  -->  1 + 6 = 7
//    942  -->  9 + 4 + 2 = 15  -->  1 + 5 = 6
// 132189  -->  1 + 3 + 2 + 1 + 8 + 9 = 24  -->  2 + 4 = 6
// 493193  -->  4 + 9 + 3 + 1 + 9 + 3 = 29  -->  2 + 9 = 11  -->  1 + 1 = 2

function digital_root($number): int
{

  $strnum = strval($number);
  $sum = 0;
  var_dump($strnum);
  if (strlen($strnum) == 1) {
    return $number;
  } else {
    foreach (str_split($strnum) as $digit) {
      $sum += $digit;
    }
    return digital_root($sum);
  }
}

digital_root(942);