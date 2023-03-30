<?php
require_once("templates/header_iframe.php");
require_once("dao/FinancialMovimentDAO.php");
require_once("dao/CategorysDAO.php");

$financialMovimentDao = new FinancialMovimentDAO($conn, $BASE_URL);
$categorysDao = new CategorysDAO($conn);

// Traz todas as categorias disponiveis para despesas
$exit_categorys = $categorysDao->getAllExitCategorys();

// Traz total de saídas do usuário
$outFinancialMoviments = $financialMovimentDao->getAllOutFinancialMoviment($userData->id);
$total_out_value = 0;

// Traz o array com os dados de saída da query personalizada 
$sql = "";
$getOutReports = $financialMovimentDao->getReports($sql, 2, $userData->id);
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
    <h1 class="text-center my-5">Relatório de Saídas <img src="<?= $BASE_URL ?>assets/home/dashboard-main/empty-wallet.png" width="64" height="64" alt=""></h1>
    <div class="entrys-search" id="entrys-search">
        <form method="POST">
            <input type="hidden" name="user_id" id="user_id" value="<?= $userData->id ?>">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Por nome:</h4>
                        <input type="text" name="name_search_exit" id="name_search_exit" class="form-control" placeholder="Ex: salário">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Por valor:</h4>
                        <!-- <input class="form-control" type="number" name="values" id="values" placeholder="ex: até 500"> -->
                        <select class="form-control" name="values_exit" id="values_exit">
                            <option value="">Selecione</option>
                            <option value="500">até R$ 500,00</option>
                            <option value="1500">de R$ 500 até R$ 1.500,00</option>
                            <option value="3000">de R$ 1.500 até R$ 3.000,00</option>
                            <option value="5000">R$ 3.000 até R$ 5.000,00</option>
                            <option value="10000">Acima de R$ 5.000,00</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h4 class="font-weight-normal">De:</h4>
                        <input type="date" name="from_date_exit" id="from_date_exit" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Até:</h4>
                        <input type="date" name="to_date_exit" id="to_date_exit" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Categoria:</h4>
                        <select class="form-control" name="category_exit" id="category_exit">
                            <option value="0">Selecione</option>
                            <?php foreach ($exit_categorys as $category) : ?>
                                <option value="<?= $category->id ?>"> <?= $category->category_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Despesa:</h4>
                        <select class="form-control" name="expense_type" id="expense_type">
                                <option value=""></option>
                                <option value="F">Fixa</option>
                                <option value="V">Variada</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-lg btn-secondary" id="print_btn" onclick="print()"> Imprimir</button>
                </div>
            </div>
        </form>
    </div>

    <div class="table_report my-3" id="search_exit"></div>

    <!-- table div thats receive all expenses without customize inputs parameters  -->
    <div class="table_report" id="table_report_exit">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data</th>
                    <th scope="col">Despesa</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Observação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($outFinancialMoviments as $outFinancialMovimentItem) : ?>
                    <?php $value = str_replace('.', '', $outFinancialMovimentItem->value);
                    $total_out_value += (float) $value; ?>
                    <tr>
                        <th scope="row"><?= $outFinancialMovimentItem->id ?></th>
                        <td><?= $outFinancialMovimentItem->description ?></td>
                        <td><?= $outFinancialMovimentItem->value ?></td>
                        <td><?= $outFinancialMovimentItem->create_at ?></td>
                        <td><?= $outFinancialMovimentItem->expense ?></td>
                        <td><?= $outFinancialMovimentItem->category ?></td>
                        <td>
                            <?php if($outFinancialMovimentItem->obs != ""): ?>
                            <a href="#!" id="grupos<?= $outFinancialMovimentItem->id ?>" onclick="openTooltip(<?= $outFinancialMovimentItem->id ?>)"> <img src="<?= $BASE_URL ?>assets/home/dashboard-main/message_alert.gif" alt="message_alert" title="ver observação" width="33" height="30"> </a>
                            <div class="tooltip_" id="tooltip_<?= $outFinancialMovimentItem->id ?>">
                                <div id="conteudo">
                                    <div class="bloco" style="display: flex; justify-content: space-between">
                                        <h5>Observação</h5>
                                        <a href="#!" id="close<?= $outFinancialMovimentItem->id ?>"><i class="fa-solid fa-xmark"></i></a>
                                    </div>
                                    <div class="bloco">
                                        <small><?= $outFinancialMovimentItem->obs ?></small>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td id="latest_moviments"><a href="#" data-toggle="modal" data-target="#exampleModalCenter<?= $outFinancialMovimentItem->id ?>" title="Editar">
                                <i class="fa-solid fa-file-pen"></i></a>
                            <a href="#" data-toggle="modal" data-target="#modal_del_finance_moviment<?= $outFinancialMovimentItem->id ?>" title="Deletar"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8"> <strong> Total: </strong> R$ <?= number_format($total_out_value, 2, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- table div thats receive all expenses without customize inputs parameters  -->

    <!-- Finance all expense moviment modal -->
    <?php foreach ($outFinancialMoviments as $outFinancialMovimentItem) : ?>
        <div class="modal fade" id="exampleModalCenter<?= $outFinancialMovimentItem->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Movimentação</h5>
                        <button type="button" class="close" data-dismiss="modal" arial-label="fechar">
                            <span arial-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= $BASE_URL ?>moviment_process.php?id=<?= $outFinancialMovimentItem->id ?>" method="post">
                            <input type="hidden" name="type" value="edit_finance_moviment">
                            <div class="form-group">
                                <label for="description">Descriçao:</label>
                                <input type="text" name="description_edit" id="" class="form-control" placeholder="Insira uma nova descrição" value="<?= $outFinancialMovimentItem->description ?>">
                            </div>
                            <div class="form-group">
                                <label for="value">Valor:</label>
                                <input type="text" name="value_edit" id="" class="form-control" placeholder="Insira um novo valor" value="<?= $outFinancialMovimentItem->value ?>">
                            </div>
                            <?php if ($outFinancialMovimentItem->type == 2) : ?>
                                <div class="form-group">
                                    <label for="expense_type">Despesa:</label>
                                    <?php if ($outFinancialMovimentItem->expense == "F") : ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="expense_type_edit" id="inlineRadio1" value="F" checked>
                                            <label class="edit_moviment_label" for="inlineRadio1">Fixa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="expense_type_edit" id="inlineRadio2" value="V">
                                            <label class="edit_moviment_label" for="inlineRadio2">Váriavel</label>
                                        </div>
                                    <?php else : ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="expense_type_edit" id="inlineRadio1" value="F">
                                            <label class="edit_moviment_label" for="inlineRadio1">Fixa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="expense_type_edit" id="inlineRadio2" value="V" checked>
                                            <label class="edit_moviment_label" for="inlineRadio2">Variada</label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="category">Categoria:</label>
                                    <select name="category_edit" id="" class="form-control">
                                        <?php foreach ($exit_categorys as $category) : ?>
                                            <?php if ($category->category_name == $outFinancialMovimentItem->category) : ?>
                                                <option value="<?= $category->id ?>" selected> <?= $category->category_name ?></option>
                                            <?php else : ?>
                                                <option value="<?= $category->id ?>"> <?= $category->category_name ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php else : ?>
                                <div class="form-group">
                                    <label for="category">Categoria:</label>
                                    <select name="category_edit" id="" class="form-control">
                                        <?php foreach ($entry_categorys as $category) : ?>
                                            <?php if ($category->category_name == $outFinancialMovimentItem->category) : ?>
                                                <option value="<?= $category->id ?>" selected> <?= $category->category_name ?></option>
                                            <?php else : ?>
                                                <option value="<?= $category->id ?>"> <?= $category->category_name ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="obs">Observação:</label>
                                <textarea class="form-control" name="obs" id="obs" rows="5" placeholder="Adicione uma observação..."><?= $outFinancialMovimentItem->obs ?></textarea>
                            </div>
                            <input type="submit" value="Enviar" class="btn btn-lg btn-success">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End Finance moviment modal -->

    <!-- Finance customize expense moviment modal -->
    <?php foreach ($getOutReports as $customizeFinancialMovimentItem) : ?>
        <div class="modal fade" id="customizeExpenseQuery<?= $customizeFinancialMovimentItem->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Movimentação</h5>
                        <button type="button" class="close" data-dismiss="modal" arial-label="fechar">
                            <span arial-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= $BASE_URL ?>moviment_process.php?id=<?= $customizeFinancialMovimentItem->id ?>" method="post">
                            <input type="hidden" name="type" value="edit_finance_moviment">
                            <div class="form-group">
                                <label for="description">Descriçao:</label>
                                <input type="text" name="description_edit" id="" class="form-control" placeholder="Insira uma nova descrição" value="<?= $customizeFinancialMovimentItem->description ?>">
                            </div>
                            <div class="form-group">
                                <label for="value">Valor:</label>
                                <input type="text" name="value_edit" id="" class="form-control" placeholder="Insira um novo valor" value="<?= $customizeFinancialMovimentItem->value ?>">
                            </div>
                            <?php if ($customizeFinancialMovimentItem->type == 2) : ?>
                                <div class="form-group">
                                    <label for="expense_type">Despesa:</label>
                                    <?php if ($customizeFinancialMovimentItem->expense == "F") : ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="expense_type_edit" id="inlineRadio1" value="F" checked>
                                            <label class="edit_moviment_label" for="inlineRadio1">Fixa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="expense_type_edit" id="inlineRadio2" value="V">
                                            <label class="edit_moviment_label" for="inlineRadio2">Variada</label>
                                        </div>
                                    <?php else : ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="expense_type_edit" id="inlineRadio1" value="F">
                                            <label class="edit_moviment_label" for="inlineRadio1">Fixa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="expense_type_edit" id="inlineRadio2" value="V" checked>
                                            <label class="edit_moviment_label" for="inlineRadio2">Váriavel</label>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="category">Categoria:</label>
                                    <select name="category_edit" id="" class="form-control">
                                        <?php foreach ($exit_categorys as $category) : ?>
                                            <?php if ($category->category_name == $financialMoviment->category) : ?>
                                                <option value="<?= $category->id ?>" selected> <?= $category->category_name ?></option>
                                            <?php else : ?>
                                                <option value="<?= $category->id ?>"> <?= $category->category_name ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php else : ?>
                                <div class="form-group">
                                    <label for="category">Categoria:</label>
                                    <select name="category_edit" id="" class="form-control">
                                        <?php foreach ($entry_categorys as $category) : ?>
                                            <?php if ($category->category_name == $financialMoviment->category) : ?>
                                                <option value="<?= $category->id ?>" selected> <?= $category->category_name ?></option>
                                            <?php else : ?>
                                                <option value="<?= $category->id ?>"> <?= $category->category_name ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="obs">Observação:</label>
                                <textarea class="form-control" name="obs" id="obs" rows="5" placeholder="Adicione uma observação..."><?= $financialMoviment->obs ?></textarea>
                            </div>
                            <input type="submit" value="Enviar" class="btn btn-lg btn-success">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End Finance moviment modal -->

    <!-- Modal para confirmação de exclusão de registro financeiro -->
    <?php foreach ($getOutReports as $financialMoviment) : ?>
        <div class="modal" tabindex="-1" id="modal_del_finance_moviment<?= $financialMoviment->id ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <p>Tem certeza que deseja excluir o registro?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <form action="<?= $BASE_URL ?>moviment_process.php?delete=s&id=<?= $financialMoviment->id ?>" method="POST">
                            <button type="submit" class="btn btn-primary">Sim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- Fim Modal para cofnirmação de exclusão de registro financeiro -->
</div>

<?php require_once("templates/footer.php"); ?>

<script>
    // $("#expense_exit").click(function(){
    //     alert($("#expense_exit").val());
    // });
</script>

<script src="js/ajax_finance_expense_request.js"></script>