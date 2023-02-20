<?php
require_once("base/globals.php");
require_once("dao/MenuDAO.php");

require_once("connection/conn.php");

$menu_Dao = new MenuDAO($conn);

$menus = $menu_Dao->findMenu();

require_once("templates/header.php"); ?>

<!-- Navbar top -->
<nav class="navbar sticky-top navbar-dark bg-secondary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/home/logo.png" alt="" width="36" height="30" class="d-inline-block align-text-top">
            <span class="">Finance Control</span>
        </a>
        <h5 class="text-white">Seu dinheiro seguro!</h5>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#">Sair</a>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navbar top -->

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            <img src="<?= $BASE_URL ?>assets/home/2.png" class="rounded w-50 my-2" alt="Cinque Terre">
            <h5>Bem vindo William</h5>
        </div>

        <ul class="list-unstyled components">
            <?php foreach ($menus as  $menu) : ?>
                <?php if ($menu->getSubMenu() == "") : ?>
                    <li><a href="<?= $BASE_URL . $menu->getUrl(); ?>" target="myFrame"><i class="<?= $menu->getClassIcon() ?>"></i><?= $menu->getMenuName() ?></a></li>
                <?php else: ?>
                    <li>
                        <a href="<?= $menu->getUrl(); ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="<?= $menu->getClassIcon() ?>"></i><?= $menu->getMenuName() ?>
                        </a>
                        <ul class="collapse list-unstyled" id="<?= substr($menu->getUrl(), 1); ?>">
                            <?php $subMenus = $menu_Dao->findSubMenu($menu->getIdMenu());
                            foreach ($subMenus as $subMenu) : ?>
                                <li>
                                    <a href="<?= $subMenu->getUrlSubMenu(); ?>"><i class="<?=$subMenu->getClassIconSubMenu()?>"></i><?= $subMenu->getSubMenuName(); ?></a>
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
                    <i class="fa-solid fa-arrow-left left" title="fechar menu"></i>
                    <i id="right" class="fa-solid fa-arrow-right" title="abrir menu"></i>
                </button>

            </div>
        </nav>

        <div class="row">
            <div class="container-fluid">
                <iframe src="dashboard-main.php" name="myFrame" fullscreen="allow" frameborder="0" width="100%"></iframe>
            </div>
        </div>
    </div>
    <!-- End Page Content  -->
</div>

<?php require_once("templates/footer.php"); ?>