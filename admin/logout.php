<?php 
require_once("../globals.php");
require_once("connection/conn.php");
require_once("dao/UserDAO.php");

$userDao = new UserDao($conn, $BASE_URL);

if ($userDao) {
    $userDao->destroyToken();
}

echo "<script>window.top.location.href = 'index.php';</script>";