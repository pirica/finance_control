<?php
require_once("../globals.php");
require_once("connection/conn.php");
require_once("dao/UserDAO.php");

$userDao = new UserDao($conn, $BASE_URL);
// Pega todos os dados do usuário
$userData = $userDao->verifyToken(true);



?>
<?php require_once("inc/header.php");?>
<body>

    <div class="container">
        <div class="jumbotron text-center">

            <h1 class="display-4">Bem vindo <?= $userData->name ?>!</h1>
            <p class="lead">Painel administrativo Finance Control.</p>
            <img class="" src="<?= $BASE_URL ?>../assets/finance_logo.png" alt="">
            <hr class="my-4">
            <p>Clique no botão ao lado esquerdo para acesso ao menu.</p>
            <small>Finance Control <?=date('Y') ?> | feito por William Silva</small>
        </div>

    </div>

</body>