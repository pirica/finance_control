<?php require_once("inc/header.php"); ?>

<body>
    <main>
        <div class="">
            <div class="offset-md-4 col-md-4">
                <div class="container">
                <h1 class="text-white text-center">Área administrativa</h1>
                    <img class="" src="<?= $BASE_URL ?>../assets/finance_logo.png" alt="">
                    
                    <form action="<?=$BASE_URL?>/admin.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="email" class="form-control" id="email" placeholder="e-mail:">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Senha</label>
                            <input type="password" class="form-control" id="password" placeholder="senha">
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