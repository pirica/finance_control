<?php 

$localhost = 'localhost';
$user = 'root';
$db = "finance_db";
$psw = "";

$conn = new PDO("mysql:host=$localhost;dbname=$db", $user, $psw);