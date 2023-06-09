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

// Popups
$popupDao = new PopupDAO($conn, $BASE_URL);
$popups = $popupDao->popup($userData->id);
date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('Y-m-d H:i:s');

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
            <!-- user name in sidebar -->
            <h5 class="user_name">
                <?= $fullName ?>
            </h5>
            <!-- User Greet -->
            <span id="DisplayClock" onload="showTime()"></span>
            <?= $msg_saudacao; ?>

        </div>

        <!-- Menu items  sidebar -->
        <?php require_once("utils/menu_items.php"); ?>

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


    <!--  TODO: Terminar lógica para sistemas de notificação por popups -->
    <!-- Welcome Popup message  -->
    <?php if ($popups != ""): ?>
        <?php if($data_atual < $popups->date_expired): ?>
            <div class="container-popup" id="container-popup">

                <div class="popup text-center" id="popup-card">
                    <button class="popup-close close_popup">x</button>
                    <h2><?= $popups->title ?></h2>
                    <p><?= $popups->description ?></p>
                    <?php if ($popups->image != ""): ?>
                        <div>
                            <img class="animated-gif" src="<?= $BASE_URL ?>assets/<?= $popups->image ?>" alt="imagm popup">
                        </div>
                    <?php endif; ?>
                    <form action="<?= $BASE_URL ?>popup_process.php" method="post">
                        <div class="form-group">
                            <label for="no_show_again"><small> Marque a caixa abaixo e clique em OK <br> para não mostrar esta
                                    mensagem novamente.</small></label>
                            <input class="form-control" type="checkbox" name="no_show_popup" id="no_show_popup" value="<?= $popups->id ?>">
                        </div>
                        <input type="submit" class="btn btn-lg btn-info" id="popup_submit" value="OK"></input>
                    </form>
                </div>

            </div>
        <?php endif; ?>
    <?php endif; ?>
    <!-- Popup messages  -->

   

</div>
<?php require_once("templates/footer.php"); ?>
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
    //const submitButtonPopup = document.getElementById("submit");

    window.addEventListener("load", () => {
        popupWindow.classList.add("active");
    });

    popupClose.forEach((close) =>
        close.addEventListener("click", () => {
            popupWindow.classList.remove("active");
            containerClose.style.display = "none";
    }));
    
    // submit desligado enquanto checkbox de confirmação estiver vazio
    $(document).ready(function() {
        $('#popup_submit').prop('disabled', true);
        $('#no_show_popup').click(function () {
            if ($(this).is(':checked')) {
                $('#popup_submit').prop('disabled', false);
            }
        });
    });
    // Popup

</script>

