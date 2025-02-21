<!-- Check to see if a string has the same amount of 'x's and 'o's. The method must return a boolean and be case insensitive. The string can contain any char.

Examples input/output:

XO("ooxx") => true
XO("xooxx") => false
XO("ooxXm") => true
XO("zpzpzpp") => true // when no 'x' and 'o' is present should return true
XO("zzoo") => false -->

<?php

function XOv1($s) {
    $x = 0;
    $o = 0;
    foreach (str_split($s) as $char) {
        if ($char == 'x' | $char == 'X') {
            $x++;
        }
        if ($char == 'o' | $char == 'O') {
            $o++;
        }
    }
    var_dump($x, $o);
    if ($x == $o) {
        return true;
    } 
    return false;
  }

//Mejor solución
function XO($s) {
    $lower = strtolower($s);
    return substr_count($lower, 'x') === substr_count($lower, 'o');
  }