<?php
require_once("globals.php");
require_once("connection/conn.php");
require_once("utils/check_password.php");
require_once("models/Message.php");

$message = new Message($BASE_URL);


$type = filter_input(INPUT_POST, "type");

if ($type === "register") {

    $email = $_POST["email"];
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // verificação minima de dados
    if ($email && $name && $lastname && $password) {

        if ($password == $confirmPassword) {

            if (password_strength($password)) {

                
                echo "ok password forte <br>";
            } else {
                $message->setMessage("A senha deve possuir ao menos 8 caracteres, sendo pelo menos 1 letra maiúscula, 1 minúscula, 1 número e 1 simbolo.", "error", "back");
            }

            echo "as senhas são iguais <br>";
        } else {
            $message->setMessage("As senhas não são iguais.", "error", "back");
        }
    } else {
        $message->setMessage("Preencha todos os dados.", "error", "back");
    }

} else if ($type === "login") {
    echo "login";
}
