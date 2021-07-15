<?php

use NumbersInWords\NumbersInWords;

include 'src/numbersinwords.php';

$number_convert = new NumbersInWords();
$valor = '1789465312654982298345,5547';
echo "<br><br> ".$number_convert->formatNumber($valor,'€', 3)."<br>";
print_r( $number_convert->numbersInWords($valor,'EN','curta'));
echo "<br><br>";
print_r( $number_convert->numbersInWords($valor,'BR','curta'));

$valor1 = '2789465312654982298345.5547';
echo "<br><br> ".$number_convert->formatNumber($valor1,'€', 3)."<br>";
print_r( $number_convert->numbersInWords($valor1,'EN','curta'));
echo "<br><br>";
print_r( $number_convert->numbersInWords($valor1,'PT','curta'));
