# Numbers in Words
Script to write numbers in words

Pequeno script para escrever números por extenso

## INSTALL with composer
```bash
composer require joaoreisweb/numbers-in-words
```

## USAGE
```php
<?php

require_once realpath("vendor/autoload.php");

use joaoreisweb\NumbersInWords;

$number_convert = new NumbersInWords();

$valor = '1114.55';
echo "<br><br>numbers PT - ".$number_convert->formatNumber($valor) ."<br>";
echo $number_convert->numbersInWords($valor,'PT');

$valor = '1114.55';
echo "<br><br>numbers BR - ".$number_convert->formatNumber($valor) ."<br>";
echo $number_convert->numbersInWords($valor,'BR');

$valor = '1116.55';
echo "<br><br>numbers EN - ".$number_convert->formatNumber($valor) ."<br>";
echo $number_convert->numbersInWords($valor,'EN');

echo '<br><br><hr>';

$valor = '2000.55';
echo "<br><br>money BR EUR - ".$number_convert->formatNumber($valor,'€') ."<br>";
echo $number_convert->moneyInWords($valor,'BR','EUR');

$valor = '2000.55';
echo "<br><br>money EN USD - ".$number_convert->formatNumber($valor,'$', 2, ' ','left') ."<br>";
echo $number_convert->moneyInWords($valor,'EN','USD');

echo '<br><br><hr>';

$valor = '1114.55';
echo "<br><br>money PT EUR - ".$number_convert->formatNumber($valor,'€') ."<br>";
echo $number_convert->moneyInWords($valor,'PT','EUR');

$valor = '1114.55';
echo "<br><br>money BR EUR - ".$number_convert->formatNumber($valor,'€') ."<br>";
echo $number_convert->moneyInWords($valor,'BR','EUR');
```
## RESULTS
```bash
numbers PT - 1 114,55
mil, cento e catorze vírgula cinquenta e cinco

numbers BR - 1 114,55
mil, cento e quatorze vírgula cinquenta e cinco

numbers EN - 1 116,55
one thousand, one hundred and sixteen point fifty five

---

money BR EUR - 2 000,55 €
dois mil euros e cinquenta e cinco cêntimos

money EN USD - $ 2 000,55
two thousand dollars and fifty five cents

---

money PT EUR - 1 114,55 €
mil, cento e catorze euros e cinquenta e cinco cêntimos

money BR EUR - 1 114,55 €
mil, cento e quatorze euros e cinquenta e cinco cêntimos

---

numbers PT curta - 1 231 231 234,55
um bilião, duzentos e trinta e um milhões, duzentos e trinta e um mil, duzentos e trinta e quatro vírgula cinquenta e cinco

numbers PT longa - 1 231 231 234,55
um mil milhões, duzentos e trinta e um milhões, duzentos e trinta e um mil, duzentos e trinta e quatro vírgula cinquenta e cinco

numbers EN curta - 1 231 231 234,55
one billion, two hundred and thirty one millions, two hundred and thirty one thousand, two hundred and thirty four point fifty five

numbers EN longa - 1 231 231 234,55
one thousand million, two hundred and thirty one millions, two hundred and thirty one thousand, two hundred and thirty four point fifty five

```





> **Short scale**
> Every new term greater than million is one thousand times larger than the previous term. 
> Thus, billion means a thousand millions 10(9), trillion means a thousand billions 10(12), and so on. 
> Thus, an n-illion equals 10(3n + 3).

> **Long scale**
> Every new term greater than million is one million times larger than the previous term. 
> Thus, billion means a million millions 10(12), trillion means a million billions 10(18), and so on. 
> Thus, an n-illion equals 10(6n). 


> A **escala curta** corresponde a um sistema de nomenclatura de números em que cada novo termo superior ao milhão é 1.000 vezes maior que o termo anterior. 
> Por exemplo, bilião ou bilhão é equivalente a mil milhões 10(9), um trilião ou trilhão é equivalente a mil biliões 10(12) e assim em diante.

> A **escala longa** corresponde a um sistema de nomenclatura de números em que cada novo termo superior ao milhão é 1.000.000 de vezes maior que o termo anterior. 
> Por exemplo, um bilião é equivalente a um milhão de milhões 10(12); um trilião é equivalente a um milhão de biliões 10(18), e assim por diante.



*fonte wikipédia* [wiki/Long_and_short_scales](https://en.wikipedia.org/wiki/Long_and_short_scales)


| PT BR - Escala Curta | PT BR - Escala Longa |   | EN - Short Scale     | EN - Long Scale       |
|----------------------|----------------------|---|----------------------|-----------------------|
| mil                  | mil                  |   | thousand             | thousand              |
| milhão               | milhão               |   | million              | million               |
| bilião               | mil milhões          |   | billion              | thousand million      |
| trilião              | bilião               |   | trillion             | billion               |
| quatrilhão           | mil biliões          |   | quadrillion          | thousand billion      |
| quintilião           | trilião              |   | quintillion          | trillion              |
| sextilião            | mil triliões         |   | sextillion           | thousand trillion     |
| septilião            | quatrilião           |   | septillion           | quadrillion           |
| octilião             | mil quatriliões      |   | octillion            | thousand quadrillion  |
| nonilião             | quintilião           |   | nonillion            | quintillion           |
| decilião             | mil quintiliões      |   | decillion            | thousand quintillion  |
| undecilião           | sextilião            |   | undecillion          | sextillion            |
| duodecilião          | mil sextiliões       |   | duodecillion         | thousand sextillion   |
| tredecilião          | septilião            |   | tredecillion         | septillion            |
| quatridecilião       | mil septiliões       |   | quattuordecillion    | thousand septillion   |
| quindecilião         | octilião             |   | quindecillion        | octillion             |
| sexdecilião          | mil octiliões        |   | sexdecillion         | thousand octillion    |
| septendecilião       | nonilião             |   | septendecillion      | nonillion             |
| octodecilião         | mil noniliões        |   | octodecillion        | thousand nonillion    |
| novendecilião        | decilião             |   | novemdecillion       | decillion             |
| vigintilião          | mil deciliões        |   | vigintillion         | thousand decillion    |
| unvigintilião        | undecilião           |   | unvigintillion       | undecillion           |
| duovigintilião       | mil undeciliões      |   | duovigintillion      | thousand undecillion  |
| trivigintilião       | duodecilião          |   | trevigintillion      | duodecillion          |
| quatrivigintilião    | mil duodeciliões     |   | quattuorvigintillion | thousand duodecillion |
| quinquavigintilião   | tredecilião          |   | quinvigintillion     | tredecillion          |

|   Continent   |                                               Short scale usage                                              |                                                                           Long scale usage                                                                           |
|:-------------:|:------------------------------------------------------------------------------------------------------------:|:--------------------------------------------------------------------------------------------------------------------------------------------------------------------:|
| Africa        | Arabic (Egypt, Libya, Tunisia), English (South Sudan), South African English                                 | Afrikaans, French (Benin, Central African Republic, Gabon, Guinea), Portuguese (Mozambique)                                                                          |
| North America | American English, Canadian English                                                                           | U.S. Spanish, Canadian French, Mexican Spanish                                                                                                                       |
| South America | Brazilian Portuguese, English (Guyana)                                                                       | American Spanish, Dutch (Suriname), French (French Guiana)                                                                                                           |
| Antarctica    | Australian English, British English, New Zealand English, Russian                                            | American Spanish (Argentina, Chile), French (France), Norwegian (Norway)                                                                                             |
| Asia          | Burmese (Myanmar), Hebrew (Israel), Indonesian, Malaysian English, Philippine English, Kazakh, Uzbek, Kyrgyz | Portuguese (East Timor, Macau), Persian (Iran)                                                                                                                       |
| Europe        | British English, Welsh, Estonian, Greek, Latvian, Lithuanian, Russian, Turkish, Ukrainian                    | Danish, Dutch, Finnish, French, German, Icelandic, Italian, Norwegian, Polish, Portuguese, Romanian, Spanish, Swedish and most other languages of continental Europe |
| Oceania       | Australian English, New Zealand English                                                                      | French (French Polynesia, New Caledonia)                                                                                                                             |
