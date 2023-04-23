<?php
require_once("globals.php");
require_once("templates/header.php");
require_once("utils/email_send.php");
require_once("models/Message.php");
require_once("connection/conn.php");
require_once("dao/UserDAO.php");


$userDao = new UserDAO($conn, $BASE_URL);
$message = new Message($BASE_URL);

$flashMessage = $message->getMessage();

if (!empty($flashMessage)) {
    $message->clearMessage();
}

if (isset($_POST["recovery_email"]) && $_POST["recovery_email"] != "") {
    $to = $_POST['recovery_email'];
    $password = str_shuffle("Finance_Control$97Br");
    $final_password = password_hash($password, PASSWORD_DEFAULT);


    if ($userDao->findByEmail($to)) {

        $userDao->recoveryPassword($to, $final_password);
            //echo "senha alterada";
        send_email($to, $password);
        $message->setMessage("Sucesso, confira seu e-mail!", "success", "index.php");
        
    } else {
        $message->setMessage("E-mail não existe em nosso sistema.", "error", "index.php");
    }

}

?>

<main>

    <div class="container login-container">
        <?php if (!empty($flashMessage["msg"])): ?>
            <div class="container text-center <?= ($flashMessage["type"]) ?> mb-5 p-2">
                <span id="msg-status">
                    <?= $flashMessage["msg"] ?>
                </span>
            </div>
        <?php endif; ?>
        <div class="row">

            <!-- Login Form -->
            <div class="col-md-6 login-form-1">
                <div class="text-center mb-2">
                    <img src="<?= $BASE_URL ?>assets/finance_logo.png" width="50%" alt="">
                </div>

                <h3>Login</h3>
                <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
                    <input type="hidden" name="type" value="login">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email_login" placeholder="Digite seu e-mail *"
                            value="<?php if (isset($_SESSION["email_login"])) {
                                echo $_SESSION["email_login"];
                            } ?>" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Digite sua senha *"
                            value="" />
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btnSubmit" value="Entrar" />
                    </div>
                </form>
                <div class=" text-center">
                    <button href="#" class="btn btn-outline-warning" data-toggle="modal"
                        data-target="#exampleModalCenter">Esqueceu a senha?</button>
                </div>
            </div>
            <!-- End Login Form -->

            <!-- Register Form -->
            <div class="col-md-6 login-form-2">
                <div class="login-logo">
                    <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
                </div>
                <h3>Criar Conta</h3>
                <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
                    <input type="hidden" name="type" value="register">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Seu Email *"
                            value="<?php if (isset($_SESSION['email'])) {
                                echo $_SESSION['email'];
                            } ?>" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="" placeholder="Nome *"
                            value="<?php if (isset($_SESSION['name'])) {
                                echo $_SESSION['name'];
                            } ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="lastname" id="" placeholder="Sobrenome *"
                            value="<?php if (isset($_SESSION['lastname'])) {
                                echo $_SESSION['lastname'];
                            } ?>">
                    </div>
                    <div class="form-group">
                        <style>
                            #alert_psw {
                                display: none;
                            }
                        </style>
                        <small id="alert_psw" style="color: yellow;">A senha deve ter 8 caracteres, sendo 1 letra
                            maiúscula, 1 minúscula, 1 número e 1 simbolo.</small>
                        <div class="pwd" style="position: relative">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Digite sua senha *" value="" />
                            <div class="p-viewer" onclick="show_password()">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pwd" style="position: relative">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                                placeholder="Confirme sua senha *" value="" />
                            <div class="p-viewer" onclick="show_password()">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btnSubmit" value="Registrar" />
                    </div>
                </form>
            </div>
            <!-- End Register Form -->

            <!-- Modal password recovery -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Recuperar senha</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="passwrod">Informe o e-mail de login:</label>
                                    <input type="email" class="form-control" id="recovery_email" name="recovery_email"
                                        placeholder="Seu Email *">
                                </div>
                                <p class="text-center">Você receberá um e-mail com instruções para recuperar a senha, se necessário confira caixa de spam ou lixo eletrônico.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Recuperar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal password recovery -->
        </div>
    </div>
</main>
<?php require_once("templates/footer.php"); ?>
<script src="js/jquery.min.js"></script>
<script>
    // Show password rules div
    $('#password').keyup(function () {

        // Se o valor estiver vazio esconde
        if ($(this).val().length == 0) {
            // Hide the element
            $('#alert_psw').hide();
        } else {
            // de outra forma ele mostra a  div
            $('#alert_psw').show();
        }
    }).keyup(); // Aciona o evento keyup, executando assim o manipulador no carregamento da página


    function show_password() {
        var password = document.getElementById('password');
        var confirmPassword = document.getElementById('confirmPassword');

        (password.type == "password") ? password.type = "text" : password.type = "password";

        (confirmPassword.type == "password") ? confirmPassword.type = "text" : confirmPassword.type = "password";
    }
</script>