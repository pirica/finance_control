<?php
require_once("globals.php");
require_once("connection/conn.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/MenuDAO.php");
require_once("dao/FinancialMovimentDAO.php");
require_once("dao/PopupDAO.php");


$financialMovimentDao = new FinancialMovimentDAO($conn, $BASE_URL);

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

// Traz total de entradas do usuário
$totalCashInflow = $financialMovimentDao->getAllCashInflow($userData->id);

// Traz total de saídas do usuário
$totalCashOutflow = $financialMovimentDao->getAllCashOutflow($userData->id);

// Calculo de quantos % as despesas representa com relação as receitas
// calculo -> despesas * 100 / receitas
if ($totalCashInflow != "0,00" && $totalCashOutflow != "0,00") {

    $expensePercent = (float) $totalCashOutflow * 100 / (float) $totalCashInflow;
    $resultExpensePercent = (int) number_format($expensePercent, 2);
} else {
    $resultExpensePercent = 0;
}

$awardColor = "";
if ($resultExpensePercent < 30) {
    $awardColor = "text-warning";
} else if ($resultExpensePercent < 40) {
    $awardColor = "text-light";
} else if ($resultExpensePercent <= 50) {
    $awardColor = "text-info";
} else {
    $awardColor = "text-danger";
}

$popupDao = new PopupDAO($conn, $BASE_URL);
//$welcomePopup = $popupDao->welcomePopup($userData->id);

?>

<?php require_once("templates/header.php"); ?>
<!-- Navbar top -->
<nav class="navbar sticky-top navbar-dark bg-secondary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= $BASE_URL ?>dashboard.php">
            <img src="<?= $BASE_URL ?>assets/finance_small_logo.png" alt="logo_finance_control" width="36" height="36"
                class="d-inline-block">
            <span>Finance Control</span>
        </a>
        <h5 class="text-white">Seu dinheiro seguro!</h5>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link text-white" href="<?= $BASE_URL ?>logout.php"> <i
                        class="fa-solid fa-right-from-bracket"></i> Sair</a>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navbar top -->

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            <div id="profile-image-container"
                style="background-image: url('<?= $BASE_URL ?>assets/home/avatar/<?= $userData->image ?>')">
                <div id="user_award">
                    <i class="fa-solid fa-award fa-3x <?= $awardColor ?>"></i>
                </div>

            </div>
            <h5 class="user_name">
                <?= $fullName ?>
            </h5>

            <span id="DisplayClock" onload="showTime()"></span>
            <?= $msg_saudacao; ?>

        </div>

        <ul class="list-unstyled components">
            <?php foreach ($menus as $menu): ?>

                <?php if ($menu->getSubMenu() == ""): ?>
                    <li><a href="<?= $BASE_URL . $menu->getUrl(); ?>" target="myFrame"
                            onclick="addClass(<?= $menu->getIdMenu() ?>)"><i class="<?= $menu->getClassIcon() ?>"></i>
                            <?= $menu->getMenuName() ?>
                        </a></li>
                <?php else: ?>
                    <li>
                        <a href="<?= $menu->getUrl(); ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                            onclick="addClass(<?= $menu->getIdMenu() ?>)">
                            <i class="<?= $menu->getClassIcon() ?>"></i>
                            <?= $menu->getMenuName() ?>
                        </a>
                        <ul class="collapse list-unstyled" id="<?= substr($menu->getUrl(), 1); ?>">
                            <?php $subMenus = $menu_Dao->findSubMenu($menu->getIdMenu()); foreach ($subMenus as $subMenu): ?>
                                <li>
                                    <a href="<?= $BASE_URL ?><?= $subMenu->getUrlSubMenu(); ?>"
                                        onclick="addClass(<?= $menu->getIdMenu() ?>)" target="myFrame"><i
                                            class="<?= $subMenu->getClassIconSubMenu() ?>"></i>
                                        <?= $subMenu->getSubMenuName(); ?>
                                    </a>
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
                <h5 class="text-center text-info">Mês atual:
                    <?= $nome_mes_atual ?>
                </h5>
            </div>
        </nav>

        <div class="row">

            <div class="container-fluid">
                <iframe src="dashboard-main.php" name="myFrame" id="myFrame" fullscreen="allow" frameborder="0"
                    width="100%"></iframe>
            </div>
        </div>
    </div>
    <!-- End Page Content  -->

    <!-- Popup messages  -->
    <?php if ($welcomePopup != ""): ?>
        <div class="container-popup" id="container-popup">
            <form action="<?= $BASE_URL ?>popup_process.php" method="post">
                <div class="popup text-center" id="popup-card">
                <button class="popup-close close_popup">x</button>
                    <h2>
                        <?= $welcomePopup->title ?>
                    </h2>
                    <p>
                        <?= $welcomePopup->description ?>
                    </p>
                    <?php if ($welcomePopup->image != ""): ?>
                        <div>
                            <img class="animated-gif" src="<?= $BASE_URL ?>assets/<?= $welcomePopup->image ?>"
                                alt="imagm popup">
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="no_show_again">Clique abaixo para não mostrar mensagem novamente.</label>
                        <input class="form-control" type="checkbox" name="no_show_popup" id="no_show_popup" value="N">
                    </div>
                    <input type="submit" class="btn btn-lg btn-info" value="OK"></input>
                    
                </div>
            </form>
        </div>
    <?php endif; ?>
    <!-- Popup messages  -->

</div>

<script>
    // deixar item do menu clicado como active
    function addClass() {
        $(document).ready(function () {
            $('ul li a').click(function () {
                $('li a').removeClass("active");
                $(this).addClass("active");
            });
        });
    }

    // Abrir e fechar Popup
    const popupWindow = document.querySelector("#popup-card");
    const popupClose = document.querySelectorAll(".popup-close");
    const containerClose = document.getElementById("container-popup");

    window.addEventListener("load", () => {
        popupWindow.classList.add("active");
    });

    popupClose.forEach((close) =>
        close.addEventListener("click", () => {
            popupWindow.classList.remove("active");
            containerClose.style.display = "none";
    }));
    // Popup

    // $(document).ready(function() {

    //     $("#no_show_popup").on("click", function() {
    //         alert("Popup");
    //     });

    // });
</script>

<?php require_once("templates/footer.php"); ?>