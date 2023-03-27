<?php

function validaSenha($senha)
{
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\w$@]{6,}$/', $senha);
}

function formatoRel($formato)
{
    if ($formato == 'P') {
        $configuracao = array(
            'orientation' => 'P',
            'logo' => '10%',
            'tdlogo' => '13%',
            'tdtextos' => '87%',
            'estabelecimento' => 'Magazine Nipêncio',
            'endereco' => '<b>Endereço:</b> Quadra 11 Conjunto F Lotes 3 e 4 Arapoangas - Planaltina/DF',
            'contato' => '<b>Contatos:</b> (61)3489-0152 &nbsp;&nbsp;<b>Email:</b> arapoanga.pdesp117@gmail.com',
            'redes' => '<b>Redes sociais:</b> Facebook / Instagram: @magazinenipenciodf'
        );
    } else {
        $configuracao = array(
            'orientation' => 'L',
            'logo' => '8%',
            'tdlogo' => '10%',
            'tdtextos' => '90%',
            'estabelecimento' => 'Magazine Nipêncio',
            'endereco' => '<b>Endereço:</b> Quadra 11 Conjunto F Lotes 3 e 4 Arapoangas - Planaltina/DF',
            'contato' => '<b>Contatos:</b> (61)3489-0152 &nbsp;&nbsp;<b>Email:</b> arapoanga.pdesp117@gmail.com',
            'redes' => '<b>Redes sociais:</b> Facebook / Instagram: @magazinenipenciodf'
        );
    }

    return $configuracao;
}

function validaData($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function mskCPF($cpf)
{
    $msk = substr($cpf, 0, 3) . '.';
    $msk .= substr($cpf, 3, 3) . '.';
    $msk .= substr($cpf, 6, 3) . '-';
    $msk .= substr($cpf, 9, 2);

    return $msk;
}

function mskCNPJ($cnpj)
{
    $msk = substr($cnpj, 0, 2) . '.';
    $msk .= substr($cnpj, 2, 3) . '.';
    $msk .= substr($cnpj, 5, 3) . '/';
    $msk .= substr($cnpj, 8, 4) . '-';
    $msk .= substr($cnpj, 12, 2);

    return $msk;
}

function dataBR($dt)
{
    $dta = $dt;
    $ano = substr("$dta", 0, 4);
    $mes = substr("$dta", 5, 2);
    $dia = substr("$dta", 8, 2);

    return $dia . "/" . $mes . "/" . $ano;
}

function limpaMascaras($valor)
{
    $valor = preg_replace('/[^0-9]/', '', $valor);
    return $valor;
}

function mskCEP($cep)
{
    $msk = substr($cep, 0, 5) . '-';
    $msk .= substr($cep, 5, 3);

    return $msk;
}

function mostraVlr($vlr)
{
    return number_format($vlr, 2, ',', '.');
}

function salvaVlr($vlr)
{
    return str_replace(",", ".", str_replace(".", "", $vlr));
}

function removerAcentos($string)
{
    return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
}

function salvaData($dt)
{
    return implode("-", array_reverse(explode("/", $dt)));
}

function nomedia($data)
{
    $ano = substr("$data", 0, 4);
    $mes = substr("$data", 5, -3);
    $dia = substr("$data", 8, 9);

    $diasemana = date("w", mktime(0, 0, 0, $mes, $dia, $ano));

    switch ($diasemana) {
        case "0":
            $diasemana = "Domingo";
            break;
        case "1":
            $diasemana = "Segunda-feira";
            break;
        case "2":
            $diasemana = "Terça-feira";
            break;
        case "3":
            $diasemana = "Quarta-feira";
            break;
        case "4":
            $diasemana = "Quinta-feira";
            break;
        case "5":
            $diasemana = "Sexta-feira";
            break;
        case "6":
            $diasemana = "Sábado";
            break;
    }

    return "$diasemana";
}

function nomeMes($m)
{
    switch ($m) {
        case "1":
            $m = "Janeiro";
            break;
        case "2":
            $m = "Fevereiro";
            break;
        case "3":
            $m = "Março";
            break;
        case "4":
            $m = "Abril";
            break;
        case "5":
            $m = "Maio";
            break;
        case "6":
            $m = "Junho";
            break;
        case "7":
            $m = "Julho";
            break;
        case "8":
            $m = "Agosto";
            break;
        case "9":
            $m = "Setembro";
            break;
        case "10":
            $m = "Outubro";
            break;
        case "11":
            $m = "Novembro";
            break;
        case "12":
            $m = "Dezembro";
            break;
    }

    return "$m";
}

function addDias($dt)
{
    $r = $dt == 1 ? '0' :
        $r = $dt == 2 ? '30' :
        $r = $dt == 3 ? '60' :
        $r = $dt == 4 ? '90' :
        $r = $dt == 5 ? '120' :
        $r = $dt == 6 ? '150' :
        $r = $dt == 7 ? '180' :
        $r = $dt == 8 ? '210' :
        $r = $dt == 9 ? '240' :
        $r = $dt == 10 ? '270' :
        $r = $dt == 11 ? '300' :
        $r = $dt == 12 ? '330' : "";

    return $r;
}
