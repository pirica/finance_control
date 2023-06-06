<?php 
ini_set('max_execution_time', 3);

$config_user = $_SERVER["HTTP_USER_AGENT"];

// HG Finance API
$url = 'https://api.hgbrasil.com/finance?format=json-&key=f43b37b9';

// INICIALIZANDO O CURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, $config_user);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_REFERER, $url);
$newsData = json_decode(curl_exec($ch));
curl_close($ch);
//print_r($newsData);

$dollar = number_format( $newsData->results->currencies->USD->buy, 2, ',', '.');
$euro = number_format($newsData->results->currencies->EUR->buy, 2, ",", '.');
$btc = number_format($newsData->results->currencies->BTC->buy, 2, ",", ".");
$ibovespa = $newsData->results->stocks->IBOVESPA->points;

?>
