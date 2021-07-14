<?php

namespace NumbersInWords;

class NumbersInWords
{

    private $numUnidadesArrPT;
    private $numUnidadesArrBR;
    private $numDezenasArr;
    private $numCentenasArr;
    private $numMilharesCurtaArr;
    private $numMilharesLongaArr;

    private $numUnidadesArrEN;
    private $numDezenasArrEN;
    private $numCentenasArrEN;
    private $numMilharesCurtaArrEN;
    private $numMilharesLongaArrEN;
    private $tipoNum;
    private $escala;


    public function __construct()
    {
        // ------- Properties -------
        $this->numUnidadesArrPT = array("zero", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove", "dez", "onze", "doze", "treze", "catorze", "quinze", "dezasseis", "dezassete", "dezoito", "dezanove");
        $this->numUnidadesArrBR = array("zero", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove", "dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezessete", "dezoito", "dezenove");
        $this->numDezenasArr = array("dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa", "cem");
        $this->numCentenasArr = array("cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos", "mil");
        $this->numMilharesCurtaArr = array("", "mil", "milhão", "bilião", "trilião", "quatrilhão", "quintilião", "sextilião", "septilião", "octilião", "nonilião", "decilião", "undecilião", "duodecilião", "tredecilião", "quatridecilião", "quindecilião", "sexdecilião", "septendecilião", "octodecilião", "novendecilião", "vigintilião", "unvigintilião", "duovigintilião", "trivigintilião", "quatrivigintilião", "quinquavigintilião");
        $this->numMilharesLongaArr = array("", "mil", "milhão", "mil milhões", "bilião", "mil biliões", "trilião", "mil triliões", "quatrilião", "mil quatriliões", "quintilião", "mil quintiliões", "sextilião", "mil sextiliões", "septilião", "mil septiliões", "octilião", "mil octiliões", "nonilião", "mil noniliões", "decilião", "mil deciliões", "undecilião", "mil undeciliões", "duodecilião", "mil duodeciliões", "tredecilião", "mil tredeciliões", "quatridecilião", "mil quatrideciliões", "quindecilião", "mil quindeciliões", "sexdecilião", "mil sexdeciliões", "septendecilião", "mil septendeciliões", "octodecilião", "mil octodeciliões", "novendecilião", "mil novendeciliões", "vigintilião");

        $this->numUnidadesArrEN = array("nought", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen");
        $this->numDezenasArrEN = array("ten", "twenty", "thirty", "fourty", "fifty", "sixty", "seventy", "eighty", "ninety", "one hundred");
        $this->numCentenasArrEN = array("one hundred", "two hundred", "three hundred", "four hundred", "five hundred", "six hundred", "seven hundred", "eight hundred", "nine hundred", "one hundred");
        $this->numMilharesCurtaArrEN = array("", "thousand", "million", "billion", "trillion", "quadrillion", "quintillion", "sextillion", "septillion", "octillion", "nonillion", "decillion", "undecillion", "duodecillion", "tredecillion", "quattuordecillion", "quindecillion", "sexdecillion", "septendecillion", "octodecillion", "novemdecillion", "vigintillion", "unvigintillion", "duovigintillion", "trevigintillion", "quattuorvigintillion", "quinvigintillion", "sexvigintillion", "septenvigintillion", "octovigintillion", "novemvigintillion", "trigintillion");
        $this->numMilharesLongaArrEN = array("", "thousand", "million", "thousand million", "billion", "thousand billion", "trillion", "thousand trillion", "quadrillion", "thousand quadrillion", "quintillion", "thousand quintillion", "sextillion", "thousand sextillion", "septillion", "thousand septillion", "octillion", "thousand octillion", "nonillion", "thousand nonillion", "decillion", "thousand decillion", "undecillion", "thousand undecillion", "duodecillion", "thousand duodecillion", "tredecillion", "thousand tredecillion", "quattuordecillion", "thousand quattuordecillion", "quindecillion", "thousand quindecillion", "sexdecillion", "thousand sexdecillion", "septendecillion", "thousand septendecillion", "octodecillion", "thousand octodecillion", "novemdecillion", "thousand novemdecillion", "vigintillion", "thousand vigintillion");
        $this->tipoNum = array(
            ["id" => "EUR", "leftSingular" => "euro", "leftPlural" => "euros", "rightSingular" => "cêntimo", "rightPlural" => "cêntimos"],
            ["id" => "USD", "leftSingular" => "dollar", "leftPlural" => "dollars", "rightSingular" => "cent", "rightPlural" => "cents"]
        );

        $this->valornumerico = $this->valornumericocheck = "";
        $this->lang="PT";
        $this->nomeMoeda = "euro";
        $this->resultadoExtenso = "";
        $this->nS = "";
        $this->nSc = "";
        $this->e = 0;
        $this->centavos = false;
        $this->centavosFindInicial = '/[\.]/';
        $this->centavosFind = '/[\,]/';
        $this->unidezcemCentavos="";
        $this->centavosExtenso = "";
        $this->extensoNumeros = "";
        $this->extensoCentavos = "";
        $this->escala;
        $this->separador;
    }

    public function numbersInWords(string $n, string $escala = 'curta', string $lang = 'PT')
    {
        $this->nS = floatval(str_replace(',', '.', $n));
        $this->lang = $lang;
        $this->escala = $escala;

        //verificar a existencia de centavos
        if ($this->is_decimal($this->nS)) {
            $this->centavos = true;
            $n_split= explode('.',round($this->nS, 2));
            $this->nS = $n_split[0];
            $this->nSc = $n_split[1];
        }

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
            $this->separador = "";
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
                    if ($this->escala == "longa" && $this->lang == "PT" ) {
                        if ($n >= 1 && $n < 100) {
                            $this->separador = " e ";
                            if ($i != $this->cNum - 1) {
                                $this->separador = ", ";
                            }
                        } else {
                            // separador
                            if ($i == $this->cNum - 1 && intval(substr($n,-2, 2) == 00)) {
                                $this->separador = " e ";
                            } else {
                                $this->separador = ", ";
                            }
                        }
                    }
                    if ($this->escala == "curta" && $this->lang == "EN") {
                        if ($n >= 1 && $n < 100) {
                            $this->separador = " and ";
                            if ($i != $this->cNum - 1) {
                                $this->separador = ", ";
                            }
                        } else {
                            // separador
                            if ($i == $this->cNum - 1 && intval(substr($n,-2, 2) == 00)) {
                                $this->separador = " and ";
                            } else {
                                $this->separador = ", ";
                            }
                        }
                    }
                }

            }

            //verifica plural das palavras
            //caso valor da centena n maior que 1
            if ($n > 1 && ($this->cNum) - ($i + 1) > 1) {
                if ($this->escala == "curta" && $this->lang == "PT") {
                    //CURTA mudar de ão para ões
                    $this->singularPlural = substr( $this->numMilharesCurtaArr[($this->cNum) - ($i + 1)] ,0, strlen($this->numMilharesCurtaArr[($this->cNum) - ($i + 1)]) - 2) + "ões";
                    //$this->singularPlural = ngettext("ão", "ões", 1);
                }

                if ($this->escala == "longa" && $this->lang == "PT") {
                    //LONGA mudar de ão para ões
                    if (substr($this->numMilharesLongaArr[($this->cNum) - ($i + 1)],-2, 2) == "ão") {
                        $this->singularPlural = substr($this->numMilharesLongaArr[($this->cNum) - ($i + 1)],0, strlen($this->numMilharesLongaArr[($this->cNum) - ($i + 1)]) - 2) + "ões";
                    } else {
                        $this->singularPlural = $this->numMilharesLongaArr[($this->cNum) - ($i + 1)];
                    }
                }

                if ($this->lang == "US") {
                    //CURTA
                    $this->singularPlural = intval($this->numMilharesCurtaArrEN[($this->cNum) - ($i + 1)]) + "s";
                }
                if ($this->lang == "UK") {
                    //Longa
                    $this->singularPlural = intval($this->numMilharesLongaArrEN[($this->cNum) - ($i + 1)]) + "s";
                }
            }else {
                //CURTA usar ão


            }


        }

        print_r($this->cNum);
    }

    private function is_decimal($val)
    {
        return is_numeric($val) && floor($val) != $val;
    }

    
}
