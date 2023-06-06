<?php
require_once("templates/header_iframe.php");
require_once("globals.php");
require_once("connection/conn.php");
require_once("dao/CategorysDAO.php");
require_once("dao/FinancialMovimentDAO.php");

// Traz todas as categorias disponíveis para entradas
$categorysDao = new CategorysDAO($conn);
$exit_categorys = $categorysDao->getAllExitCategorys();

$financialMovimentDao = new FinancialMovimentDAO($conn, $BASE_URL);

$exitFinancialScheduled = $financialMovimentDao->getAllCashOutflowScheduled($userData->id);


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
    
    @media (max-width: 1024px){
        .actions {text-align: center;}
    }
</style>

<body id="iframe-body">
    <div class="container-fluid">
        <h1 class="text-center my-5">Agendar despesa <i class="fa-solid fa-calendar-minus text-danger"></i></h1>

        <!-- Cash Inflow | Cash outflow form  -->
        <section>
            <div class="text-center">
                <small class="text-info"> <strong> As despesas são agendadas para as 8hrs da data escolhida! </strong></small>
            </div>
            <div class="actions p-5 mb-4 bg-light rounded-3 shadow-sm">
                <form action="<?= $BASE_URL ?>moviment_process.php" method="post">
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="type_action" value="2">
                    <div class="row">
                        <div class="col-md-3 pb-2">
                            <h4 class="font-weight-normal">Descriçao</h4>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Ex: Conta de luz">
                        </div>
                        <div class="col-md-2 pb-2">
                            <h4 class="font-weight-normal">Valor</h4>
                            <input type="text" name="value" id="value" class="form-control money" placeholder="Ex: 80,00:">
                        </div>
                        <div class="col-md-2 pb-2 " id="">
                            <h4 class="font-weight-normal">Despesa</h4>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="expense_type" id="fixa" class="expense_type" value="F">
                                <label class="form-check-label" for="inlineRadio1">Fixa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="expense_type" id="variavel" class="expense_type" value="V">
                                <label class="form-check-label" for="inlineRadio2">Variada</label>
                            </div>
                        </div>
                        <div class="col-md-2 pb-2" id="category">
                            <h4 class="font-weight-normal">Categoria</h4>
                            <select class="form-control" name="category" id="category_exit">
                                <option value="">Selecione</option>
                                <?php foreach ($exit_categorys as $category) : ?>
                                    <option value="<?= $category->id ?>"> <?= $category->category_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 pb-2">
                            <h4>Data:</h4>
                            <input class="form-control "type="date" name="date_scheduled" id="">
                        </div>
                        <div class="col-md-1 button">
                            <label for="submit">
                                <i class="fa-regular fa-square-plus fa-3x" title="Adicionar"></i>
                            </label>
                            <input type="submit" id="submit" value="">
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </form>
            </div>
        </section>
        <!-- Cash Inflow | Cash outflow form  -->
        
       <div class="container">
        <h4 class="font-weight-normal mt-5">Últimas 10 despesas agendadas</h4>
            <div class="table_report" id="table_report_entry">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Data</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Observação</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exitFinancialScheduled as $exitFinancialMovimentItem) : ?>
                            <?php $value = str_replace('.', '', $exitFinancialMovimentItem->value);
                            $total_outflow_value += (float) $value; ?>

                            <tr>
                                <th scope="row">
                                    <?= $exitFinancialMovimentItem->id ?>
                                </th>
                                <td>
                                    <?= $exitFinancialMovimentItem->description ?>
                                </td>
                                <td>
                                    <?= $exitFinancialMovimentItem->value ?>
                                </td>
                                <td>
                                    <?= $exitFinancialMovimentItem->create_at ?>
                                </td>
                                <td>
                                    <?= $exitFinancialMovimentItem->category ?>
                                </td>

                                <td>
                                    <?php if ($exitFinancialMovimentItem->obs != "") : ?>
                                        <a href="#!" id="grupos<?= $exitFinancialMovimentItem->id ?>" onclick="openTooltip(<?= $exitFinancialMovimentItem->id ?>)"><img src="<?= $BASE_URL ?>assets/home/dashboard-main/message_alert.gif" alt="message_alert" title="ver observação" width="33" height="30"> </a>
                                        <div class="tooltip_" id="tooltip_<?= $exitFinancialMovimentItem->id ?>">
                                            <div id="conteudo">
                                                <div class="bloco">
                                                    <h5>Observação</h5>
                                                    <a href="#!" id="close<?= $exitFinancialMovimentItem->id ?>"><i class="fa-solid fa-xmark"></i></a>
                                                </div>
                                                <div class="bloco">
                                                    <small>
                                                        <?= $exitFinancialMovimentItem->obs ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8"> <strong> Total: </strong> R$
                                <?= number_format($total_outflow_value, 2, ",", "."); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
       </div>
    </div>
</body>


<?php require_once("templates/footer.php"); ?>

<script>
    // aplly money mask to input
    $('.money').mask('000.000.000.000.000,00', {
        reverse: true
    });
</script>