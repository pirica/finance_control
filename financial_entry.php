<?php
require_once("templates/header_iframe.php");
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
    <h1 class="text-center my-5">Relatório de Entradas <img src="<?= $BASE_URL ?>assets/home/dashboard-main/full-wallet.png" width="64" height="64" alt=""></h1>
    <div class="entrys-search">
        <form action="<?= $BASE_URL ?>reports_process.php" method="POST">
            <input type="hidden" name="user_id" id="user_id" value="<?= $userData->id ?>">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Pesquisar por nome:</h4>
                        <input type="text" name="name_search" id="name_search" class="form-control" placeholder="Ex: salário">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Pesquisar por valor:</h4>
                        <input class="form-control" type="number" name="values" id="values" placeholder="ex: até 500">
                        <!-- <select class="form-control" name="values" id="values">
                            <option value="">Selecione</option>
                            <option value="0 - 500,00">até R$ 500,00</option>
                            <option value="500 - 1500">de R$ 500 até R$ 1.500,00</option>
                            <option value="1500 - 3000">de R$ 1.500 até R$ 3.000,00</option>
                            <option value="3000 - 5000">R$ 3.000 até R$ 5.000,00</option>
                            <option value="10000">Acima de R$ 5.000,00</option>
                        </select> -->
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h4 class="font-weight-normal">De:</h4>
                        <input type="date" name="from_date" id="from_date" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Até:</h4>
                        <input type="date" name="to_date" id="to_date" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <h4 class="font-weight-normal">Categoria:</h4>
                        <select class="form-control" name="categogry" id="category">
                            <option value="">Selecione</option>
                            <option value="10">Pessoal</option>
                        </select>
                    </div>
                </div>
                <!-- <div class="col-md-1">
                   <input type="submit" class="btn btn-lg btn-success" value="Adicionar"></input>
               </div> -->
            </div>
        </form>
    </div>
    <div class="table_report my-3" id="test"></div>
    <!-- TODO: colocar botão imprimir relatório  -->
    <div class="table_report" style="display: none">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Observação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Venda disso</td>
                    <td>R$ 800,00</td>
                    <td>10/03/2023</td>
                    <td>Pessoal</td>
                    <td>obs</td>
                    <td>Editar | Excluir</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Salario</td>
                    <td>R$ 1.400,00</td>
                    <td>05/03/2023</td>
                    <td>Salario</td>
                    <td>obs</td>
                    <td>Editar | Excluir</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Salario</td>
                    <td>R$ 1.400,00</td>
                    <td>05/03/2023</td>
                    <td>Salario</td>
                    <td>obs</td>
                    <td>Editar | Excluir</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7"> <strong> Total: </strong> R$ 2.400,00</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php require_once("templates/footer.php"); ?>
<script>
    $(document).ready(function() {

        $("input").keyup(function() {
            var name_search = $("#name_search").val();
            var values = $("#values").val();
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            var category = $("#category").val();
            var user_id = $("#user_id").val();

            $.post("financial_entry_ajax.php", {
                name_search: name_search,
                values: values,
                from_date: from_date,
                to_date: to_date,
                category: category,
                user_id: user_id
            }, function(data, status) {
                $("#test").html(data);
            });
        });

        $("#values").on("click", function(){
            var values = $("#values").val();
            var name_search = $("#name_search").val();
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            var category = $("#category").val();
            var user_id = $("#user_id").val();
            
            $.post("financial_entry_ajax.php", {
                values: values,
                name_search: name_search,
                from_date: from_date,
                to_date: to_date,
                category: category,
                user_id: user_id
            }, function(data, status) {
                $("#test").html(data);
            });
        });

        $("#category").on("click", function(){
            var values = $("#values").val();
            var name_search = $("#name_search").val();
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            var category = $("#category").val();
            var user_id = $("#user_id").val();
            
            $.post("financial_entry_ajax.php", {
                values: values,
                name_search: name_search,
                from_date: from_date,
                to_date: to_date,
                category: category,
                user_id: user_id
            }, function(data, status) {
                $("#test").html(data);
            });
        });


    });
</script>


