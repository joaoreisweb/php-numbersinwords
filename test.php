<?php


//include 'src/numbersinwords.php';
use NumbersInWords\NumbersInWords;



$number_convert = new NumbersInWords();


$valor = '1116.55';
echo "<br><br>money BR EUR - ".$number_convert->formatNumber($valor,'€') ."<br>";
print_r( $number_convert->moneyInWords($valor,'BR','EUR'));

$valor = '1116.55';
echo "<br><br>money PT EUR - ".$number_convert->formatNumber($valor,'€') ."<br>";
print_r( $number_convert->moneyInWords($valor,'PT','EUR'));


$valor = '1116.55';
echo "<br><br>money EN USD - ".$number_convert->formatNumber($valor,'€') ."<br>";
print_r( $number_convert->moneyInWords($valor,'EN','USD'));