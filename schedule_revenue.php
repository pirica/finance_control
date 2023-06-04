<?php
require_once("templates/header_iframe.php");
require_once("globals.php");
require_once("connection/conn.php");
require_once("dao/CategorysDAO.php");



// Traz todas as categorias disponiceis para entradas
$categorysDao = new CategorysDAO($conn);
$entry_categorys = $categorysDao->getAllEntryCategorys();

?>


<body id="iframe-body">
    <div class="container">
        <h1 class="text-center my-5">Agendar receita <i class="fa-solid fa-calendar-plus text-success"></i></h1>

        <!-- Cash Inflow | Cash outflow form  -->
        <section>
            <div class="actions p-5 mb-4 bg-light rounded-3 shadow-sm">
                <form action="<?= $BASE_URL ?>moviment_process.php" method="post">
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="type_action" value="1">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="font-weight-normal">Descriçao</h4>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Ex: salário">
                        </div>
                        <div class="col-md-2">
                            <h4 class="font-weight-normal">Valor</h4>
                            <input type="text" name="value" id="value" class="form-control money" placeholder="Ex: 80,00:">
                        </div>
                        <div class="col-md-3" id="category">
                            <h4 class="font-weight-normal">Categoria</h4>
                            <select class="form-control" name="category" id="category_entry">
                                <option value="">Selecione</option>
                                <?php foreach ($entry_categorys as $category) : ?>
                                    <option value="<?= $category->id ?>"> <?= $category->category_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <h4>Data:</h4>
                            <input class="form-control "type="date" name="date_scheduled" id="">
                        </div>
                        <div class="col-md-2 button">
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
    </div>
</body>


<?php require_once("templates/footer.php"); ?>

<script>
    // aplly money mask to input
    $('.money').mask('000.000.000.000.000,00', {
        reverse: true
    });
</script>