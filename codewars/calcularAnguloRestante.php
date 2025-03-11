<?php
/*
You are given two interior angles (in degrees) of a triangle.

Write a function to return the 3rd.

Note: only positive integers will be tested.
NOTA: La suma de los 3 ángulos de un triángulo es 180 grados.
*/

function otherAngle($a, $b) {
    return 180 - $a - $b;
  }