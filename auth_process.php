<?php
require_once("globals.php");
require_once("connection/conn.php");
require_once("utils/check_password.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");

$userDao = new UserDAO($conn, $BASE_URL);
$message = new Message($BASE_URL);

$_SESSION['email_login'] = $_POST['email_login'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['lastname'] = $_POST['lastname'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['confirmPassword'] = $_POST['confirmPassword'];

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

                // checa se o e-mail já existe
                if ($userDao->findByEmail($email) === false) {

                    $user = new User();

                    // Criação de token e senha final
                    $userToken = $user->generateToken(); // random cria a string, bin2hex modifica a String deixando mais complexa
                    $final_password = password_hash($password, PASSWORD_DEFAULT);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $final_password;
                    $user->token = $userToken;

                    $auth = true;

                    // criação e login automático
                    $userDao->create($user, $auth);                     

                }else {
                    // envia mensagem de erro, usuário já existe
                    $message->setMessage("O e-mail: $email já existe em nosso sistema, tente outro e-mail.", "error", "back");
                }
               
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
   
    $email = filter_input(INPUT_POST, "email_login");
    $password = filter_input(INPUT_POST, "password");

    // Tenta atenticas usuário
    if ($userDao->authenticatorUser($email, $password)) {

        // Dá as boas vindas para o usuário que efetuou o login
        $message->setMessage("Seja bem-vindo!", "success", "dashboard.php");
    }else {

         // envia msg de erro, usuário ou senha não encontrados
         $message->setMessage("E-mail e/ou senha inválidos.", "error", "back");
    }

}else {

     // se tentar algo estranho expulsa para a index
     $message->setMessage("Informações inválidas.", "error", "index.php");
}
