<?php

use NumbersInWords\NumbersInWords;

include 'src/numbersinwords.php';

$number_convert = new NumbersInWords();
$valor = '1789315662554982298345';
echo "<br><br>".$number_convert->formatNumber($valor,'€', 3);
echo "<br><br>curta EN - ";
print_r( $number_convert->numbersInWords($valor,'EN','curta'));
echo "<br><br>curta BR - ";
print_r( $number_convert->numbersInWords($valor,'BR','curta'));
echo "<br><br>curta PT - ";
print_r( $number_convert->numbersInWords($valor,'PT','curta'));

echo "<br><br>longa EN - ";
print_r( $number_convert->numbersInWords($valor,'EN','longa'));
echo "<br><br>longa BR - ";
print_r( $number_convert->numbersInWords($valor,'BR','longa'));
echo "<br><br>longa PT - ";
print_r( $number_convert->numbersInWords($valor,'PT','longa'));

echo "<hr>";

$valor1 = '2789465312654564982298345.5547';
echo "<br><br> ".$number_convert->formatNumber($valor1,'€', 3)."<br>";
echo "<br><br>curta EN - ";
print_r( $number_convert->numbersInWords($valor1,'EN','curta'));
echo "<br><br>curta BR - ";
print_r( $number_convert->numbersInWords($valor1,'BR','curta'));
echo "<br><br>curta PT - ";
print_r( $number_convert->numbersInWords($valor1,'PT','curta'));

echo "<br><br>longa EN - ";
print_r( $number_convert->numbersInWords($valor1,'EN','longa'));
echo "<br><br>longa BR - ";
print_r( $number_convert->numbersInWords($valor1,'BR','longa'));
echo "<br><br>longa PT - ";
print_r( $number_convert->numbersInWords($valor1,'PT','longa'));

