<?php
require_once("inc/header.php"); 
require_once("../globals.php");
require_once("connection/conn.php");
require_once("dao/UserDAO.php");

$userDao = new UserDao($conn, $BASE_URL);
// Pega todos os dados do usuário
$userData = $userDao->verifyToken(true);

?>

<body>
    <div class="container">
        <h1 class="text-center">Usuários</h1>
        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Data de Registro</th>
                </tr>
            </thead>
            <tbody >
                <tr>
                    <th scope="row">
                        <div id="profile-image-container"
                            style="background-image: url('<?= $BASE_URL ?>../assets/home/avatar/<?= $userData->image ?>')">
                        </div>
                    </th>
                    <td class="align-middle"><?= $userData->name?></td>
                    <td class="align-middle"><?= $userData->email ?></td>
                    <td class="align-middle"><?= $userData->register_date?></td>
                </tr>
               
            </tbody>
        </table>
    </div>



</body>
<html>