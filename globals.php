<?php

session_start();

$BASE_URL = "http://" . $_SERVER["SERVER_NAME"] . dirname($_SERVER["REQUEST_URI"]."?") . '/';

// USADO PARA SAUDAÇÃO DE ACORDO COM HORARIO DO DIA
// PEGA O HORÁRIO ATUAL DE ACORDO COM O TIMEZONE DE SP 
$timezone = new DateTimeZone('America/Sao_Paulo');
$agora = new DateTime('now', $timezone);
$hora_atual = $agora->format('H');
$msg_saudacao = "";

if($hora_atual > 0 && $hora_atual <= 12){
    $msg_saudacao = "Bom dia!";
}else if($hora_atual > 12 && $hora_atual < 18){
    $msg_saudacao = "Boa tarde!";
}else{
    $msg_saudacao = "Boa noite!";
}

$mes = date('m');
$nome_mes_atual = "";
switch($mes):
    case "01":
        $nome_mes_atual = "Janeiro";
        break;
    case "02":
        $nome_mes_atual = "Fevereiro";
        break;
    case "03":
        $nome_mes_atual = "Março";
        break;
    case "04":
        $nome_mes_atual = "Abril";
        break;
    case "05":
        $nome_mes_atual = "Maio";
        break;
    case "06":
        $nome_mes_atual = "Junho";
        break;
    case "07":
        $nome_mes_atual = "Julho";
        break;
    case "08":
        $nome_mes_atual = "Agosto";
        break;
    case "09":
        $nome_mes_atual = "Setembro";
        break;
    case "10":
        $nome_mes_atual = "Outubro";
        break;
    case "11":
        $nome_mes_atual = "Novembro";
        break;
    case "12":
        $nome_mes_atual = "Dezembro";
        break;
endswitch;