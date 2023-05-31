<?php
$config_user = $_SERVER["HTTP_USER_AGENT"];

// HG Finance API
$url = 'https://newsapi.org/v2/top-headlines?sources=google-news-br&apiKey=27a753fdaaab471189742fb09cac21a3';

// INICIALIZANDO O CURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, $config_user);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_REFERER, $url);
$newsData = json_decode(curl_exec($ch));
curl_close($ch);


//print_r($newsData);

?>

<h1>News</h1>
<?php 
