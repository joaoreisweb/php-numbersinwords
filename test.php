<?php

require_once realpath("vendor/autoload.php");

use joaoreisweb\NumbersInWords;


$number_convert = new NumbersInWords();

$valor = '1114.55';
echo "<br><br>numbers PT - ".$number_convert->formatNumber($valor) ."<br>";
print_r( $number_convert->numbersInWords($valor,'PT'));

$valor = '1114.55';
echo "<br><br>numbers BR - ".$number_convert->formatNumber($valor) ."<br>";
print_r( $number_convert->numbersInWords($valor,'BR'));

$valor = '1116.55';
echo "<br><br>numbers EN - ".$number_convert->formatNumber($valor) ."<br>";
print_r( $number_convert->numbersInWords($valor,'EN'));

echo '<br><br><hr>';

$valor = '2000.55';
echo "<br><br>money BR EUR - ".$number_convert->formatNumber($valor,'€') ."<br>";
print_r( $number_convert->moneyInWords($valor,'BR','EUR'));

$valor = '2000.55';
echo "<br><br>money EN USD - ".$number_convert->formatNumber($valor,'$', 2, ' ','left') ."<br>";
print_r( $number_convert->moneyInWords($valor,'EN','USD'));

echo '<br><br><hr>';

$valor = '1114.55';
echo "<br><br>money PT EUR - ".$number_convert->formatNumber($valor,'€') ."<br>";
print_r( $number_convert->moneyInWords($valor,'PT','EUR'));

$valor = '1114.55';
echo "<br><br>money BR EUR - ".$number_convert->formatNumber($valor,'€') ."<br>";
print_r( $number_convert->moneyInWords($valor,'BR','EUR'));


echo '<br><br><hr>';

$valor = '1231231234.55';
echo "<br><br>numbers PT - ".$number_convert->formatNumber($valor) ."<br>";
print_r( $number_convert->numbersInWords($valor,'PT','curta'));

echo "<br><br>numbers EN - ".$number_convert->formatNumber($valor) ."<br>";
print_r( $number_convert->numbersInWords($valor,'EN','longa'));

