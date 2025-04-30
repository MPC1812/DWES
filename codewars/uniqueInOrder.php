<?php
// https://www.codewars.com/kata/54e6533c92449cc251001667/train/php
function uniqueInOrder($iterable)
{
    $ret = [];
    if (is_string($iterable)) {
        for ($i = 0; $i < strlen($iterable); $i++) {
            if ($iterable[$i] !== $iterable[($i - 1)]) {
                $ret[] = $iterable[$i];
            }
        }
    } else {
        foreach ($iterable as $item) {
            if (!in_array($item, $ret)) {
                $ret[] = $item;
            }
        }
    }
    return $ret;
}
