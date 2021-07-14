<?php

use NumbersInWords\NumbersInWords;

include 'src/numbersinwords.php';

$number_convert = new NumbersInWords();
echo $number_convert->numbersInWords('7896545,55 €');