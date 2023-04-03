<?php
require_once("templates/header_iframe.php");
require_once("dao/FinancialMovimentDAO.php");
require_once("dao/CategorysDAO.php");

$financialMovimentDao = new FinancialMovimentDAO($conn, $BASE_URL);
$categorysDao = new CategorysDAO($conn);


?>

<style>
    table,
    th,
    td {
        border: 1px solid #cecfd5;
    }

    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none !important;
        -webkit-appearance: none !important;
    }
</style>


<div class="container-fluid">
    <h1 class="text-center my-5">Relatório Geral <img src="<?= $BASE_URL ?>assets/home/dashboard-main/reports.png" width="64" height="64" alt=""></h1>
    <div class="report_general">
        
        <!-- form month div -->
        <div class="offset-md-5 col-md-2 my-3">
            <form action="" method="post">
                <div class="form-group">
                    <label for="monthy">Pesquisar por Mês:</label>
                    <input class="form-control" type="month" name="" id="">
                </div>
            </form>
        </div>
        <!-- End form month div -->

        <!-- Graphic report div -->
        <div class="offset-md-4 col-md-4 my-5">
            <h1 class="text-center">Gráfico</h1>
            <canvas id="myChart2"></canvas>
        </div>
        <!-- End Graphic report div -->

    </div>
    <canvas id="myChart2"></canvas>
</div>

<?php require_once("templates/footer.php"); ?>