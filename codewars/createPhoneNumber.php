<!-- Write a function that accepts an array of 10 integers (between 0 and 9), that returns a string of those numbers in the form of a phone number.

Example
createPhoneNumber([1,2,3,4,5,6,7,8,9,0]); // => returns "(123) 456-7890"
The returned format must be correct in order to complete this challenge.

Don't forget the space after the closing parentheses! -->

<?php
function createPhoneNumber($numbersArray) : string
{
    $arrayvalido = false;
    foreach ($numbersArray as $number) {
        if ($number >= 0 && $number <= 9) {
            $arrayvalido = true;
        }
    }

    if ($arrayvalido && count($numbersArray) == 10) {
        $resultado = "(" . $numbersArray[0] . $numbersArray[1] . $numbersArray[2] . ") " . $numbersArray[3] . $numbersArray[4] . $numbersArray[5] 
        . "-" . $numbersArray[6] . $numbersArray[7] . $numbersArray[8] . $numbersArray[9];
        return $resultado;
    } else {
        return "Error";
    }
}

function createPhoneNumberv2(array $digits): string {
    return sprintf("(%d%d%d) %d%d%d-%d%d%d%d", ...$digits);
  }
