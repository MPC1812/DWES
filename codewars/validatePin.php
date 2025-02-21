<?php
// ATM machines allow 4 or 6 digit PIN codes and PIN codes cannot contain anything but exactly 4 digits or exactly 6 digits.

// If the function is passed a valid PIN string, return true, else return false.

// Examples (Input --> Output)
// "1234"   -->  true
// "12345"  -->  false
// "a234"   -->  false

function validatePin(string $pin): bool
{
    $patron4 = '/(\d{4})/';
    $patron6 = '/(\d{6})/';
    if (preg_match($patron4, $pin) && strlen($pin) ==4 || preg_match($patron6, $pin) && strlen($pin) ==6) {
        return true;
    } else {
        return false;
    }
}

function validatePin2(string $pin): bool
{
    return preg_match('/^(\d{4}|\d{6})$/', $pin);
}