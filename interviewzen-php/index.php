<?php
//declare(strict_types = 1);

function sum(int $a, int $b)
{
    return $a + $b;
}

$a = 5;
$b = "4";

echo " $a + $b = " . sum($a, $b);

/*
si se usa declare(stryct_types=1):
    Fatal error: Uncaught TypeError: Argument 2 passed to sum() must be of the type int, string given
    TypeError: Argument 2 passed to sum() must be of the type int, string given, called
sino:
    5 + 4 = 9
*/