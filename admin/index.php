<?php
require_once("inc/header.php"); 
require_once("models/Message.php");
$message = new Message($BASE_URL);
$flashMessage = $message->getMessage();

if (!empty($flashMessage)) {
    $message->clearMessage();
}

?>

<body id="login-body">
    <main>

        <div class="">
            <div class="offset-md-4 col-md-4">
                <?php if (!empty($flashMessage["msg"])): ?>
                    <div class="container text-center <?= ($flashMessage["type"]) ?> mb-5 p-2">
                        <span id="msg-status">
                            <?= $flashMessage["msg"] ?>
                        </span>
                    </div>
                <?php endif; ?>
                <div class="container rounded" id="container-login">
                    <h1 class="text-white text-center">Área administrativa</h1>
                    <img class="" src="<?= $BASE_URL ?>../assets/finance_logo.png" alt="">

                    <form action="<?= $BASE_URL ?>auth_admin.php" method="post">
                        <input type="hidden" name="type" value="login">
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="e-mail:">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Senha</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="senha">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>
<html>