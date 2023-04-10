<?php 

$localhost = 'localhost';
$user = 'root';
$db = "finance_db";
$psw = "";

$conn = new PDO("mysql:host=$localhost;dbname=$db", $user, $psw);

// Habilitar erros PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);