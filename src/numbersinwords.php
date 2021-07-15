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

        $this->lang = "PT"; /// PT EN
        $this->escala = 'curta'; /// curta longa | short long
        $this->nomeMoeda = "euro";
        $this->e = 0;
        $this->centavos = false;

    }

    public function numbersInWords(string $n, string $lang = 'PT', string $escala = 'curta')
    {
        $this->resultadoExtenso = "";
        $this->centavosExtenso = "";
        $this->nS = "";
        $this->nSc = "";
        $this->nS = str_replace(',', '.', $n);
        $this->lang = strtoupper($lang);
        $this->escala = $escala;
        $this->e = floatval($this->nS);
        $n_split =[];

        //verificar a existencia de centavos
        echo "<br>1 ".$this->nS;
        if (is_numeric(floatval($this->nS)) ) {
            
            $this->centavos = true;
            $n_split = explode('.', $this->nS);
            $this->nS = strval($n_split[0]);
            $this->e = intval($this->nS);
            $this->nSc = strval(substr($n_split[1], 0, 2));
            echo "<br>2 ".$this->nS;
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
                    if ($this->lang == "PT" ) {
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
                if ($n > 1 && ($this->cNum) - ($i + 1) > 1) {
                    if ($this->escala == "curta" && $this->lang == "PT") {
                        //CURTA mudar de ão para ões
                        $length_val = strval($this->numMilharesCurtaArr[intval($this->cNum) - ($i + 1)]);
                        $singularPlural = mb_substr($length_val, 0, -2) . "ões";
                        
                    }

                    if ($this->escala == "longa" && $this->lang == "PT") {
                        //LONGA mudar de ão para ões
                        $length_val = strval($this->numMilharesLongaArr[intval($this->cNum) - ($i + 1)]);
                        if (strval(mb_substr($length_val, -2, 2)) == "ão") {
                            $singularPlural = mb_substr($length_val, 0, -2) . "ões";
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
                    if ($this->escala == "curta" && $this->lang == "PT") {
                        $singularPlural = $this->numMilharesCurtaArr[intval($this->cNum) - ($i + 1)];
                    }
                    //LONGA usar ão
                    if ($this->escala == "longa" && $this->lang == "PT") {
                        $singularPlural = $this->numMilharesLongaArr[intval($this->cNum) - ($i + 1)];
                    }
                    //CURTA 
                    if ($this->escala == "curta" && $this->lang == "EN") {
                        $singularPlural = $this->numMilharesCurtaArrEN[intval($this->cNum) - ($i + 1)];
                    }
                    //LONGA 
                    if ($this->escala == "longa" && $this->lang == "EN") {
                        $singularPlural = $this->numMilharesCurtaArrEN[intval($this->cNum) - ($i + 1)];
                    }
                }

                //verifica se o número é diferente de 1
                //verifica se o número ésta na casa dos milhares e começa por 1
                if ($n == 1 && $this->e <= 1999 && $this->e > 1) {
                    $n = 0;
                    $espaco = " ";
                    $separador = "";
                    if ($this->lang == "EN" ) {
                        // one thousand
                        $separador = " one ";
                    }
                }
                if ($this->lang == "PT" ) {
                    //milhares de milhao
                    if ($n == 1 && (strlen($this->nS) == 10 || strlen($this->nS) == 16 || strlen($this->nS) == 22 || strlen($this->nS) == 28 || strlen($this->nS) == 34)) {
                        $n = 0;
                    }
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
            $this->nomeMoeda = "";
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
                if ($this->lang == "PT") {
                    $this->centavosExtenso = " vírgula " . $this->dezenasUnidadesValor($this->unidezcemCentavos);
                }
                if ($this->lang == "EN" ) {
                    $this->centavosExtenso = " point " . $this->dezenasUnidadesValor($this->unidezcemCentavos);
                    //$this->centavosExtenso = " and " . $this->dezenasUnidadesValor($this->unidezcemCentavos);
                }
            }
        }
        //extensoCentavos=centavosExtenso;
        //acrescentar moeda + centavos na variavel
        $this->resultadoExtenso .= $this->centavosExtenso;

        //escrever resultado

        $this->valorextenso = $this->resultadoExtenso;

        return $this->valorextenso;


    }

    //////////////////////////////////////////////////////////////////////////
    //FUNCTIONS
    //////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////unidades + dezenas
    private function dezenasUnidadesValor($uni) {
        //0X
        $primeiroNum = substr($uni,-1, 1);
        //X0
        $segundoNum = substr($uni,-2, 1);
        $dezenasUnidadesValor = "";
        //unidades e dezenas
        if ($uni > 0 && $uni < 20) {
            if ($this->lang == "PT") {
                $dezenasUnidadesValor = strval($this->numUnidadesArrPT[$uni]);
            }
            if ($this->lang == "BR") {
                $dezenasUnidadesValor = strval($this->numUnidadesArrBR[$uni]);
            }
            if ($this->lang == "EN" ) {
                $dezenasUnidadesValor = strval($this->numUnidadesArrEN[$uni]);
            }


        }
        if ($uni >= 20 && $uni <= 99) {
            // X0
            if ($primeiroNum == 0) {
                if ($this->lang == "PT" || $this->lang == "BR") {
                    $dezenasUnidadesValor = strval($this->numDezenasArr[$segundoNum - 1]);
                }
                if ($this->lang == "EN") {
                    $dezenasUnidadesValor = strval($this->numDezenasArrEN[$segundoNum - 1]);
                }

            }
            // XX
            if ($primeiroNum != 0) {
                if ($this->lang == "PT" || $this->lang == "BR") {
                    $dezenasUnidadesValor = strval($this->numDezenasArr[$segundoNum - 1]) . " e " . strval($this->numUnidadesArrPT[$primeiroNum]);
                }
                if ($this->lang == "EN") {
                    $dezenasUnidadesValor = strval($this->numDezenasArrEN[$segundoNum - 1]) . " " . strval($this->numUnidadesArrEN[$primeiroNum]);
                }
            }
        }
        return $dezenasUnidadesValor;
    }

    //////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////centenas
    private function centenasValor($v) {
        $centenasValor = $valorCentenas = "";
        if ($v != 0) {
            //00X
            $unidade = intval(substr($v,-1, 1));
            //0X0
            $dezena = intval(substr($v,-2, 1));
            //0XX
            $dezenas = intval(substr($v,-2, 2));
            //X00
            $centena = intval(substr($v,-3, 1));
            //centenas
            if ($this->lang == "PT" || $this->lang == "BR") {
                $valorCentenas = strval($this->numCentenasArr[$centena - 1]);
            }
            if ($this->lang == "EN" ) {
                $valorCentenas = strval($this->numCentenasArrEN[$centena - 1]);
            }

            if ($v < 100) {
                $centenasValor = $this->dezenasUnidadesValor($dezenas);
            }
            if ($v == 100) {
                if ($this->lang == "PT" || $this->lang == "BR") {
                    $centenasValor = "cem";
                }
                if ($this->lang == "EN" ) {
                    $centenasValor = "one hundred";
                }
            }
            if ($v > 100 && $v <= 199) {

                if ($this->lang == "PT" || $this->lang == "BR") {
                    $centenasValor = "cento" . " e " . $this->dezenasUnidadesValor($dezenas);
                }
                if ($this->lang == "EN" ) {
                    $centenasValor = "one hundred" . " and " . $this->dezenasUnidadesValor($dezenas);
                }
            }
            if ($v >= 200 && $v < 1000) {
                // X00
                if ($centena != 0 && $dezena == 0 && $unidade == 0) {
                    $centenasValor = $valorCentenas;
                } else {// 0X0  00X  XX0  0XX  X0X  XXX 
                    if ($this->lang == "PT" || $this->lang == "BR") {
                        $centenasValor = $valorCentenas . " e " . $this->dezenasUnidadesValor($dezenas);
                    }
                    if ($this->lang == "EN" ) {
                        $centenasValor = $valorCentenas . " and " . $this->dezenasUnidadesValor($dezenas);
                    }
                }
            }
        }
        return $centenasValor;
    }


    public function formatNumber($valor, $sign=''){
        $sign_temp = ($sign!='')?" ".$sign:"";
        $v = floatval($valor);
        return number_format($v,2,',',' ') . $sign_temp;
    }
}
