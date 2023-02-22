<?php

require_once("globals.php");
require_once("connection/conn.php");
require_once("utils/check_password.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");

$userDao = new UserDAO($conn, $BASE_URL);

$message = new Message($BASE_URL);


$type = filter_input(INPUT_POST, "type");

if ($type == "update") {
    echo "update";
}else if($type == "changePassword"){
    
    $password = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirmPassword");

    $userData = $userDao->verifyToken();
    $id = $userData->id;

    if ($password) {
        
        if ($password == $confirmPassword) {

            if (password_strength($password)) {

                $passwordChanged = password_hash($password, PASSWORD_DEFAULT);

                $userData->password = $passwordChanged;
                $userData->id = $id;

                $userDao->changePassword($userData);
                
            }else {
                $message->setMessage("A senha deve possuir ao menos 8 caracteres, sendo pelo menos 1 letra maiúscula, 1 minúscula, 1 número e 1 simbolo.", "error", "back");
            }
            
        }else {
            $message->setMessage("As senhas não são iguais.", "error", "back");
        }

    }else {

        $message->setMessage("Prencha o campo senha e confirmação de senha para poder altera-la", "error", "back");
        
    }

}
