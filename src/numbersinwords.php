<?php
///////////////////////////////////////////////////
///////////////////////////////////////////////////
//// NUMBERS IN WORDS
//// Números por Extenso v.3.2 git
////
//// v.4 15.07.2021 php version -> major update
//// v.3.2 15.06.2021 jquery version
//// v.3.1 02.04.2020 jquery version
//// v.3 02.04.2020
//// v.2 29.05.2013
//// v.1 11.04.2012
////
//// created by: João Reis
//// joaoreis.pt
////

//// 1 - Numbers in words
//// OPTIONS 
//// @string number - string | number
//// @string lang - PT | BR | EN
//// @string scale - short | long
////

//// 2 - Money in words
//// OPTIONS 
//// @string number - string | number
//// @string lang - PT | BR | EN
//// @string coin - EUR | USD
//// @string scale - short | long

//// 3 - Format Number
//// OPTIONS 
//// @string number - string | number | only numbers
//// @string sign - € | $ | any
//// @int decimal_cases - EUR | USD
//// @boolean decimal_space - true | false
//// @string sign_side - right | left

//// LANGUAGE
//// PT - Portuguese Portugal
//// BR - Portuguese Brasil
//// EN - English

////
//////////////////////////////////////////////////
//////////////////////////////////////////////////

namespace NumbersInWords;

class NumbersInWords
{

    private $numUnidadesArrPT;
    private $numUnidadesArrBR;
    private $numDezenasArrPT;
    private $numCentenasArrPT;
    private $numMilharesCurtaArrPT;
    private $numMilharesLongaArrPT;

    private $numUnidadesArrEN;
    private $numDezenasArrEN;
    private $numCentenasArrEN;
    private $numMilharesCurtaArrEN;
    private $numMilharesLongaArrEN;
    private $tipoNum;

    private $centavos;
    private $e;
    private $lang;
    private $escala;


    public function __construct()
    {
        // ------- Properties -------
        $this->numUnidadesArrPT = array("zero", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove", "dez", "onze", "doze", "treze", "catorze", "quinze", "dezasseis", "dezassete", "dezoito", "dezanove");
        $this->numUnidadesArrBR = array("zero", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove", "dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezessete", "dezoito", "dezenove");
        $this->numDezenasArrPT = array("dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa", "cem");
        $this->numCentenasArrPT = array("cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos", "mil");
        $this->numMilharesCurtaArrPT = array("", "mil", "milhão", "bilião", "trilião", "quatrilhão", "quintilião", "sextilião", "septilião", "octilião", "nonilião", "decilião", "undecilião", "duodecilião", "tredecilião", "quatridecilião", "quindecilião", "sexdecilião", "septendecilião", "octodecilião", "novendecilião", "vigintilião", "unvigintilião", "duovigintilião", "trivigintilião", "quatrivigintilião", "quinquavigintilião");
        $this->numMilharesLongaArrPT = array("", "mil", "milhão", "mil milhões", "bilião", "mil biliões", "trilião", "mil triliões", "quatrilião", "mil quatriliões", "quintilião", "mil quintiliões", "sextilião", "mil sextiliões", "septilião", "mil septiliões", "octilião", "mil octiliões", "nonilião", "mil noniliões", "decilião", "mil deciliões", "undecilião", "mil undeciliões", "duodecilião", "mil duodeciliões", "tredecilião", "mil tredeciliões", "quatridecilião", "mil quatrideciliões", "quindecilião", "mil quindeciliões", "sexdecilião", "mil sexdeciliões", "septendecilião", "mil septendeciliões", "octodecilião", "mil octodeciliões", "novendecilião", "mil novendeciliões", "vigintilião");

        $this->numUnidadesArrEN = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen");
        $this->numDezenasArrEN = array("ten", "twenty", "thirty", "fourty", "fifty", "sixty", "seventy", "eighty", "ninety", "one hundred");
        $this->numCentenasArrEN = array("one hundred", "two hundred", "three hundred", "four hundred", "five hundred", "six hundred", "seven hundred", "eight hundred", "nine hundred", "one hundred");
        $this->numMilharesCurtaArrEN = array("", "thousand", "million", "billion", "trillion", "quadrillion", "quintillion", "sextillion", "septillion", "octillion", "nonillion", "decillion", "undecillion", "duodecillion", "tredecillion", "quattuordecillion", "quindecillion", "sexdecillion", "septendecillion", "octodecillion", "novemdecillion", "vigintillion", "unvigintillion", "duovigintillion", "trevigintillion", "quattuorvigintillion", "quinvigintillion", "sexvigintillion", "septenvigintillion", "octovigintillion", "novemvigintillion", "trigintillion");
        $this->numMilharesLongaArrEN = array("", "thousand", "million", "thousand million", "billion", "thousand billion", "trillion", "thousand trillion", "quadrillion", "thousand quadrillion", "quintillion", "thousand quintillion", "sextillion", "thousand sextillion", "septillion", "thousand septillion", "octillion", "thousand octillion", "nonillion", "thousand nonillion", "decillion", "thousand decillion", "undecillion", "thousand undecillion", "duodecillion", "thousand duodecillion", "tredecillion", "thousand tredecillion", "quattuordecillion", "thousand quattuordecillion", "quindecillion", "thousand quindecillion", "sexdecillion", "thousand sexdecillion", "septendecillion", "thousand septendecillion", "octodecillion", "thousand octodecillion", "novemdecillion", "thousand novemdecillion", "vigintillion", "thousand vigintillion");
        $this->tipoNum = array(
            ["id" => "EUR", "leftSingular" => "euro", "leftPlural" => "euros", "rightSingular" => "cêntimo", "rightPlural" => "cêntimos"],
            ["id" => "USD", "leftSingular" => "dollar", "leftPlural" => "dollars", "rightSingular" => "cent", "rightPlural" => "cents"]
        );

        $this->lang = "PT"; /// PT EN
        $this->escala = 'curta'; /// curta longa | short long
        $this->e = 0;
        $this->centavos = false;
    }

    /**
     * Numbers In Words - convert any number to words
     * @param the parameters used by the method
     *** String $n decimal number | string
     *** String $lang // PT | BR | EN
     *** String $escala // curta | longa
     * @return the number in words
     * @throws 
     */
    public function numbersInWords(string $n, string $lang = 'PT', string $escala = 'curta')
    {
        $this->resultadoExtenso = "";
        $this->centavosExtenso = "";
        $this->nSc = "";
        $this->nS = str_replace(',', '.', $n);
        $this->lang = strtoupper($lang);
        $this->escala = $escala;
        $this->e = floatval($this->nS);
        $n_split = [];

        //verificar a existencia de centavos
        if (is_numeric(floatval($this->nS))) {
            $this->centavos = true;
            $n_split = explode('.', $this->nS);
            $this->nS = strval($n_split[0]);
            $this->e = intval($this->nS);
            if (isset($n_split[1])) {
                $this->nSc = strval(substr($n_split[1], 0, 2));
            } else {
                $this->centavos = false;
            }
        }

        $this->unidezcemCentavos = intval($this->nSc);

        // conta quantas centenas existem
        /// 000 000 000 000 000 = 5
        /// 00 000 000 = 3
        /// 0 000 000 000 = 4
        $this->cNum = intval(ceil(strlen($this->nS) / 3));

        // escreve de centena em centena pela ordem crescente
        // 00 000 000 000
        // 1   2   3   4
        for ($i = 0; $i < $this->cNum; $i++) {
            $espaco = " ";
            $separador = "";
            $singularPlural = "";
            $n;

            //conta quantas unidades existe na ultima centena
            /// X00 000 000 000 = 3
            /// X0 000 000 000 = 2
            /// X 000 000 000 = 1
            $r = intval(3 - (((3 * $this->cNum) - strlen($this->nS))));

            if ($i == 0) {
                $n = intval(substr($this->nS, 0, $r));
            } else {
                $n = intval(substr($this->nS, $r + (3 * ($i - 1)), 3));
            }

            if ($n != 0) {
                if ($i > 0) {
                    //se a centena for menor que 100 ou seja de dois numeros
                    //e se forem valores inteiros 100 200 300 ... 900 usa o separador " e "
                    //e se não estiver na primeira ou na ultima centena
                    if ($this->lang == "PT" || $this->lang == "BR") {
                        if ($n >= 1 && $n < 100) {
                            $separador = " e ";
                            if ($i != $this->cNum - 1) {
                                $separador = ", ";
                            }
                        } else {
                            // separador
                            if ($i == $this->cNum - 1 && intval(substr($n, -2, 2) == 00)) {
                                $separador = " e ";
                            } else {
                                $separador = ", ";
                            }
                        }
                    }
                    if ($this->lang == "EN") {
                        if ($n >= 1 && $n < 100) {
                            $separador = " and ";
                            if ($i != $this->cNum - 1) {
                                $separador = ", ";
                            }
                        } else {
                            // separador
                            if ($i == $this->cNum - 1 && intval(substr($n, -2, 2) == 00)) {
                                $separador = " and ";
                            } else {
                                $separador = ", ";
                            }
                        }
                    }
                }


                //verifica plural das palavras
                //caso valor da centena n maior que 1
                $centenas_block = intval(($this->cNum) - ($i + 1));
                if ($n > 1 && $centenas_block > 1) {
                    if ($this->escala == "curta" &&  ($this->lang == "PT" || $this->lang == "BR")) {
                        //CURTA mudar de ão para ões
                        $length_val = strval($this->numMilharesCurtaArrPT[intval($this->cNum) - ($i + 1)]);
                        $singularPlural = mb_substr($length_val, 0, strlen($length_val) - 3) . "ões";

                        //singularPlural = String(numMilharesCurtaArr[(cNum) - (i + 1)]).substr(0, numMilharesCurtaArr[(cNum) - (i + 1)].length - 2) + "ões";
                    }

                    if ($this->escala == "longa" &&  ($this->lang == "PT" || $this->lang == "BR")) {
                        //LONGA mudar de ão para ões
                        $length_val = $this->numMilharesLongaArrPT[intval($this->cNum) - ($i + 1)];
                        if (strval(mb_substr($length_val, -2, 2)) == "ão") {
                            $singularPlural = mb_substr($length_val, 0, strlen($length_val) - 3) . "ões";
                        } else {
                            $singularPlural = $length_val;
                        }
                    }

                    if ($this->escala == "curta" && $this->lang == "EN") {
                        //CURTA
                        $singularPlural = strval($this->numMilharesCurtaArrEN[intval($this->cNum) - ($i + 1)]) . "s";
                    }
                    if ($this->escala == "longa" && $this->lang == "EN") {
                        //Longa
                        $singularPlural = strval($this->numMilharesLongaArrEN[intval($this->cNum) - ($i + 1)]) . "s";
                    }
                } else {
                    //CURTA usar ão
                    if ($this->escala == "curta" &&  ($this->lang == "PT" || $this->lang == "BR")) {
                        $singularPlural = $this->numMilharesCurtaArrPT[intval($this->cNum) - ($i + 1)];
                    }
                    //LONGA usar ão
                    if ($this->escala == "longa" && ($this->lang == "PT" || $this->lang == "BR")) {
                        $singularPlural = $this->numMilharesLongaArrPT[intval($this->cNum) - ($i + 1)];
                    }
                    //CURTA 
                    if ($this->escala == "curta" && $this->lang == "EN") {
                        $singularPlural = $this->numMilharesCurtaArrEN[intval($this->cNum) - ($i + 1)];
                    }
                    //LONGA 
                    if ($this->escala == "longa" && $this->lang == "EN") {
                        $singularPlural = $this->numMilharesLongaArrEN[intval($this->cNum) - ($i + 1)];
                    }
                }

                //verifica se o número é diferente de 1
                //verifica se o número esta na casa dos milhares e começa por 1
                if ($n == 1 && $this->e <= 1999 && $this->e > 1) {
                    $n = 0;
                    $espaco = " ";
                    $separador = "";
                    if ($this->lang == "EN") {
                        // one thousand
                        $separador = " one ";
                    }
                }

                //milhares de milhao
                if ($n == 1 && (strlen($this->nS) == 10 || strlen($this->nS) == 16 || strlen($this->nS) == 22 || strlen($this->nS) == 28 || strlen($this->nS) == 34)) {
                    $n = 1;
                }

                //escreve resultado na variavel
                $this->resultadoExtenso .= $separador . $this->centenasValor($n) . $espaco . $singularPlural;
            } else {
                //se a ultima centena for zero acrescenta um espaço
                if ($i == $this->cNum - 1) {
                    if (substr($this->resultadoExtenso, -3, 3) == "ões") {
                        $espaco = " de ";
                    }
                    $this->resultadoExtenso .= $espaco;
                }
            }
        }

        //limpar texto quando não existirem valores
        //ou o valor for igual a zero
        if ($this->e == 0 || strlen($this->nS) == 0) {
            //$this->nomeMoeda = "";
            $this->resultadoExtenso = "";
            $this->centavosExtenso = "";
        }
        $this->extensoNumeros = $this->resultadoExtenso;

        //centavos
        if ($this->centavos) {
            if (strlen($this->nSc) == 1) {
                $this->unidezcemCentavos = $this->unidezcemCentavos * 10;
            }
            if ($this->e == 0) {
                $this->resultadoExtenso = $this->dezenasUnidadesValor($this->unidezcemCentavos);
            } else {
                if ($this->lang == "PT" || $this->lang == "BR") {
                    $this->centavosExtenso = " vírgula " . $this->dezenasUnidadesValor($this->unidezcemCentavos);
                }
                if ($this->lang == "EN") {
                    $this->centavosExtenso = " point " . $this->dezenasUnidadesValor($this->unidezcemCentavos);
                    //$this->centavosExtenso = " and " . $this->dezenasUnidadesValor($this->unidezcemCentavos);
                }
            }
        }

        //acrescentar moeda + centavos na variavel
        $this->resultadoExtenso .= $this->centavosExtenso;

        //escrever resultado
        return $this->resultadoExtenso;
    }

    /**
     * Money In Words - convert any number to words with coin description
     * @param the parameters used by the method
     *** String $n decimal number | string
     *** String $lang // PT | BR | EN
     *** String $coin // EUR | USD
     *** String $escala // curta | longa
     * @return the number in words
     * @throws 
     */
    public function moneyInWords($valornumerico, $lang = "PT", $coin = "EUR", string $escala = 'curta')
    {

        $this->lang = $lang;
        $this->escala = $escala;

        $resultadoExtenso = $centavosExtenso = $nomeMoeda = $separadorDecimal = $textCentimos = $unidezcemCentavos = "";


        $this->numbersinwords($valornumerico, $this->lang, $this->escala);
        $resultadoExtenso = $this->extensoNumeros;


        $tiposelected = array();

        foreach ($this->tipoNum as $item) {
            if ($item['id'] == $coin) {
                $tiposelected = $item;
            }
        }

        //definir plural da moeda
        if ($this->e == 0) {
            $nomeMoeda = "";
        } else if ($this->e == 1) {
            $nomeMoeda = array_key_exists('leftSingular', $tiposelected)  ? $tiposelected['leftSingular'] : "";
        } else {
            $nomeMoeda = array_key_exists('leftPlural', $tiposelected)  ? $tiposelected['leftPlural'] : "";
        }


        if ($this->centavos) {
            $n = intval($this->nSc);
            if ($coin != "") {
                if ($this->unidezcemCentavos == '01') {
                    $textCentimos = array_key_exists('rightSingular', $tiposelected)  ? " " . $tiposelected['rightSingular'] : "";
                } else {
                    $textCentimos = array_key_exists('rightPlural', $tiposelected)  ? " " . $tiposelected['rightPlural'] : "";
                }
            }
            if ($n == 0) {
                $textCentimos = "";
            }
            if ($n > 0) {
                if ($this->lang == "PT" || $this->lang == "BR") {
                    $separadorDecimal = " e ";
                }
                if ($this->lang == "EN") {
                    $separadorDecimal = " and ";
                }
            }

            if ($this->e == 0) {
                $resultadoExtenso = $this->dezenasUnidadesValor($this->unidezcemCentavos) . $textCentimos;
            } else {
                $centavosExtenso = $separadorDecimal . $this->dezenasUnidadesValor($this->unidezcemCentavos) . $textCentimos;
            }
        }
        //acrescentar moeda + centavos na variavel
        $resultadoExtenso .= $nomeMoeda . $centavosExtenso;
        return $resultadoExtenso;
    }

    /**
     * Format Number - format number with spaces or coin values '1 000 000 €' or '1 000 000,50 €' or '$ 1 000 000,50' or '$ 1000000,50'
     * @param the parameters used by the method
     *** String $n decimal number | string
     *** String $sign any | € | $
     *** Int $decimal_cases 2
     *** Boolean $decimal_space true | false
     *** $sign_side left | right
     * @return the number in words
     * @throws 
     */
    public function formatNumber($valor, $sign = '', $decimal_cases = 2, $decimal_space = true, $sign_side = 'right')
    {
        $sign_left = ($sign != '' && $sign_side == 'left') ? $sign . " " : "";
        $sign_right = ($sign != '' && $sign_side == 'right') ? " " . $sign : "";
        $n_split = explode(',', str_replace('.', ',', strval($valor)));
        $n_left = ($decimal_space) ? strrev(implode(' ', str_split(strrev($n_split[0]), 3))) : $n_split[0];
        $n_right = "";
        if (isset($n_split[1]) && $decimal_cases > 0) {
            $n_right = substr($n_split[1], 0, $decimal_cases);
            $n_right = ($n_right != '' && $decimal_space) ? ',' . implode(' ', str_split($n_right, 3)) : '';
        }
        return  $sign_left . $n_left . $n_right . $sign_right;
    }

    //////////////////////////////////////////////////////////////////////////
    // FUNCTIONS
    //////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////centenas
    private function centenasValor($v)
    {
        $centenasValor = $valorCentenas = "";
        if ($v != 0) {
            //00X
            $unidade = intval(substr($v, -1, 1));
            //0X0
            $dezena = intval(substr($v, -2, 1));
            //0XX
            $dezenas = intval(substr($v, -2, 2));
            //X00
            $centena = intval(substr($v, -3, 1));
            //centenas
            if ($this->lang == "PT" || $this->lang == "BR") {
                $valorCentenas = strval($this->numCentenasArrPT[$centena - 1]);
            }
            if ($this->lang == "EN") {
                $valorCentenas = strval($this->numCentenasArrEN[$centena - 1]);
            }

            if ($v < 100) {
                $centenasValor = $this->dezenasUnidadesValor($dezenas);
            }
            if ($v == 100) {
                if ($this->lang == "PT" || $this->lang == "BR") {
                    $centenasValor = "cem";
                }
                if ($this->lang == "EN") {
                    $centenasValor = "one hundred";
                }
            }
            if ($v > 100 && $v <= 199) {

                if ($this->lang == "PT" || $this->lang == "BR") {
                    $centenasValor = "cento" . " e " . $this->dezenasUnidadesValor($dezenas);
                }
                if ($this->lang == "EN") {
                    $centenasValor = "one hundred" . " and " . $this->dezenasUnidadesValor($dezenas);
                }
            }
            if ($v >= 200 && $v < 1000) {
                // X00
                if ($centena != 0 && $dezena == 0 && $unidade == 0) {
                    $centenasValor = $valorCentenas;
                } else { // 0X0  00X  XX0  0XX  X0X  XXX 
                    if ($this->lang == "PT" || $this->lang == "BR") {
                        $centenasValor = $valorCentenas . " e " . $this->dezenasUnidadesValor($dezenas);
                    }
                    if ($this->lang == "EN") {
                        $centenasValor = $valorCentenas . " and " . $this->dezenasUnidadesValor($dezenas);
                    }
                }
            }
        }
        return $centenasValor;
    }

    //////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////unidades + dezenas
    private function dezenasUnidadesValor($uni)
    {
        //0X
        $primeiroNum = substr($uni, -1, 1);
        //X0
        $segundoNum = substr($uni, -2, 1);
        $dezenasUnidadesValor = "";
        //unidades e dezenas
        if ($uni > 0 && $uni < 20) {
            if ($this->lang == "PT") {
                $dezenasUnidadesValor = strval($this->numUnidadesArrPT[$uni]);
            }
            if ($this->lang == "BR") {
                $dezenasUnidadesValor = strval($this->numUnidadesArrBR[$uni]);
            }
            if ($this->lang == "EN") {
                $dezenasUnidadesValor = strval($this->numUnidadesArrEN[$uni]);
            }
        }
        if ($uni >= 20 && $uni <= 99) {
            // X0
            if ($primeiroNum == 0) {
                if ($this->lang == "PT" || $this->lang == "BR") {
                    $dezenasUnidadesValor = strval($this->numDezenasArrPT[$segundoNum - 1]);
                }
                if ($this->lang == "EN") {
                    $dezenasUnidadesValor = strval($this->numDezenasArrEN[$segundoNum - 1]);
                }
            }
            // XX
            if ($primeiroNum != 0) {
                if ($this->lang == "PT" || $this->lang == "BR") {
                    $dezenasUnidadesValor = strval($this->numDezenasArrPT[$segundoNum - 1]) . " e " . strval($this->numUnidadesArrPT[$primeiroNum]);
                }
                if ($this->lang == "EN") {
                    $dezenasUnidadesValor = strval($this->numDezenasArrEN[$segundoNum - 1]) . " " . strval($this->numUnidadesArrEN[$primeiroNum]);
                }
            }
        }
        return $dezenasUnidadesValor;
    }

    //////////////////////////////////////////////////////////////////////////
    // END FUNCTIONS
    //////////////////////////////////////////////////////////////////////////
}
