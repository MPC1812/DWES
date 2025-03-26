<?php
// The first century spans from the year 1 up to and including the year 100, the second century - from the year 101 up to and including the year 200, etc.

// Task
// Given a year, return the century it is in.

// Examples
// 1705 --> 18
// 1900 --> 19
// 1601 --> 17
// 2000 --> 20
// 2742 --> 28

function centuryFromYear(int $year): int{
    if ($year%100 == 0) {
        return (int)($year/100);
    }
    return (int)($year/100)+1;
  }

//Mejor solución
  function centuryFromYearv2(int $year): int{
    return ceil($year/100);
  };


  echo centuryFromYear(1705);
  echo "<br>";
  echo centuryFromYear(1900);
  echo "<br>";
  echo centuryFromYearv2(1601);
  echo "<br>";
  echo centuryFromYearv2(2000);
  echo "<br>";
  echo centuryFromYearv2(2742);