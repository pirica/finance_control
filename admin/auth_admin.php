<?php
require_once("../globals.php");
require_once("connection/conn.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");

$userDao = new UserDAO($conn, $BASE_URL);
$message = new Message($BASE_URL);


if ($_POST) {
   
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    
    // Tenta atenticas usuário
    if ($userDao->authenticatorUserAdmin($email, $password)) {

        // echo "teste"; exit;

        // Dá as boas vindas para o usuário que efetuou o login
        $message->setMessage("Seja bem-vindo!", "success", "admin.php");
    }else {

         // envia msg de erro, usuário ou senha não encontrados
         $message->setMessage("E-mail e/ou senha inválidos.", "error", "back");
    }

}else {

     // se tentar algo estranho expulsa para a index
     $message->setMessage("Informações inválidas.", "error", "index.php");
}
