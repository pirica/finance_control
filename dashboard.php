<?php
require_once("globals.php");
require_once("connection/conn.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/MenuDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);

// pega o menu dinamico para o sidebar
$menu_Dao = new MenuDAO($conn);
$menus = $menu_Dao->findMenu();

// Pega todos os dados do usuário
$userData = $userDao->verifyToken(true);

$fullName = $user->getFullName($userData);

if ($userData->image == "") {
    $userData->image = "user.png";
}

?>

<?php require_once("templates/header.php"); ?>
<!-- Navbar top -->
<nav class="navbar sticky-top navbar-dark bg-secondary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?= $BASE_URL ?>assets/finance_small_logo.png" alt="" width="36" height="36" class="d-inline-block align-text-top">
            <span class="">Finance Control</span>
        </a>
        <h5 class="text-white">Seu dinheiro seguro!</h5>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link text-white" href="<?= $BASE_URL ?>logout.php"> <i class="fa-solid fa-right-from-bracket"></i> Sair</a>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navbar top -->

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>/assets/home/avatar/<?= $userData->image ?>')">
            </div>
            <h5><?= $fullName ?></h5>

            <span id="DisplayClock" onload="showTime()"></span>
            <?= $msg_saudacao; ?>

        </div>

        <ul class="list-unstyled components">
            <?php foreach ($menus as  $menu) : ?>
                <?php if ($menu->getSubMenu() == "") : ?>
                    <li><a href="<?= $BASE_URL . $menu->getUrl(); ?>" target="myFrame" onclick="addClass(<?= $menu->getIdMenu() ?>)"><i class="<?= $menu->getClassIcon() ?>"></i><?= $menu->getMenuName() ?></a></li>
                <?php else : ?>
                    <li>
                        <a href="<?= $menu->getUrl(); ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" onclick="addClass(<?= $menu->getIdMenu() ?>)">
                            <i class="<?= $menu->getClassIcon() ?>"></i><?= $menu->getMenuName() ?>
                        </a>
                        <ul class="collapse list-unstyled" id="<?= substr($menu->getUrl(), 1); ?>">
                            <?php $subMenus = $menu_Dao->findSubMenu($menu->getIdMenu());
                            foreach ($subMenus as $subMenu) : ?>
                                <li>
                                    <a href="<?= $BASE_URL ?><?= $subMenu->getUrlSubMenu(); ?>"  onclick="addClass(<?= $menu->getIdMenu() ?>)" target="myFrame"><i class="<?= $subMenu->getClassIconSubMenu() ?>"></i><?= $subMenu->getSubMenuName(); ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info" onclick="mudaIconeToogle()">
                    <i class="fa-solid fa-arrows-left-right fa-2x"></i>
                </button>
                <h5 class="text-center text-info">Mês de Referência atual: <?= $nome_mes_atual ?></h5>
            </div>
        </nav>

        <div class="row">
            <div class="container-fluid">
                <iframe src="dashboard-main.php" name="myFrame" id="myFrame" fullscreen="allow" frameborder="0" width="100%"></iframe>
            </div>
        </div>
    </div>
    <!-- End Page Content  -->
</div>

<script>
    function addClass() {
        $(document).ready(function(){
        $('ul li a').click(function(){
            $('li a').removeClass("active");
            $(this).addClass("active");
        });
        });
    }
    
</script>

<?php require_once("templates/footer.php"); ?>