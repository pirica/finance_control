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

$meses = ["janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"];

$mes_numb = ltrim(date("m"), '0');

$nome_mes_atual = $meses[$mes_numb];