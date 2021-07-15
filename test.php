<?php

use NumbersInWords\NumbersInWords;

include 'src/numbersinwords.php';

$number_convert = new NumbersInWords();
$valor = '1789465312654982298345,5547';
echo "<br><br> ".$valor."<br>";
print_r( $number_convert->numbersInWords($valor,'EN','curta'));
echo "<br><br>";
print_r( $number_convert->numbersInWords($valor,'PT','curta'));

$valor1 = '2789465312654982298345,55';
echo "<br><br> ".$number_convert->formatNumber($valor1,'€')."<br>";
print_r( $number_convert->numbersInWords($valor1,'EN','curta'));
echo "<br><br>";
print_r( $number_convert->numbersInWords($valor1,'PT','curta'));
