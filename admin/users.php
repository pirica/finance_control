<?php
require_once("inc/header.php"); 
require_once("../globals.php");
require_once("connection/conn.php");
require_once("dao/UserDAO.php");

$userDao = new UserDao($conn, $BASE_URL);
// Pega todos os dados do usuário
$userData = $userDao->verifyToken(true);

$users = $userDao->findAllUsers();

// print_r($users); exit;

?>

<body>
    <div class="container">
        <h1 class="text-center text-danger">Usuários</h1>
        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Data de Registro</th>
                </tr>
            </thead>
            <tbody >
                <?php foreach($users as $user): ?>
                <tr>
                    <th scope="row">
                        <div id="profile-image-container"
                            style="background-image: url('<?= $BASE_URL ?>../assets/home/avatar/<?= $user->image ?>')">
                        </div>
                    </th>
                    <td class="align-middle"><?= $user->id ?></td>
                    <td class="align-middle"><?= $user->getFullName($user)?></td>
                    <td class="align-middle"><?= $user->email ?></td>
                    <td class="align-middle"><?= $user->register_date?></td>
                </tr>
                <?php endforeach; ?>
               
            </tbody>
        </table>
    </div>



</body>
<html>