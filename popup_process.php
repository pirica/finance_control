<?php
require_once("globals.php");
// require_once("connection/conn.php");
require_once("dao/UserDAO.php");
require_once("dao/PopupDAO.php");

$popupDao = new PopupDAO($conn, $BASE_URL);

// resgata dados do usuário
$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken();

$localhost = 'localhost';
$user = 'root';
$db = "finance_db";
$psw = "";

$conn = new PDO("mysql:host=$localhost;dbname=$db", $user, $psw);

$no_show_popup = filter_input(INPUT_POST, "no_show_popup");

$query = $this->conn->prepare("UPDATE popup_users SET show_welcome_popup = 'N', 
welcome_status = :welcome_status 
WHERE users_id = 13");

$query->bindParam(':welcome_status', 'S');
$query->execute();

if ($query->execute()) {
    # code...
}

// if ($no_show_popup != "") {
//     $popupDao->updateWelcomePopupUser($userData->id);
// }else {
//     echo $no_show_popup;
// }


?>