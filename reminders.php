<?php
require_once("templates/header_iframe.php");
require_once("globals.php");
require_once("connection/conn.php");
require_once("dao/CardsDAO.php");



?>

<style>
    .list-group {
        padding: 20px;
    }
</style>

<div class="container">
    <h1 class="text-center my-5">Meus Lembretes</h1>

    <form action="<?= $BASE_URL ?>reminders_process.php" method="post" enctype="multipart/form-data">
        <h4 class="font-weight-normal">Cadastrar lembrete</h4>
        <div class="reminder bg-light rounded-3 shadow-sm my-3">
            <!-- <div class="image flex-item">
                <label for="file">
                    <i class="fa-solid fa-camera fa-3x"></i> 
                
                </label>
                <input type="file" id="file" name="file">
            </div> -->
            <div class="form-group titulo flex-item">
                <label for="">Titulo:</label>
                <div class=""> <input class="form-control "type="text" name="description" id="" placeholder="titulo do lembrete.."> </div>
            </div>
            <div class="form-group descricao flex-item">
                <label for="">Descrição:</label>
                <div class=""> <input class="form-control "type="text" name="description" id="" placeholder="ex: descrição ..."> </div>
            </div>
            <div class="form-group flex-item">
                <label for="">Data: </label>
                <input class="form-control "type="date" name="date" id="">
            </div>
            <div class="button flex-item">
                <label for="submit">
                    <i class="fa-regular fa-square-plus fa-3x" title="Adicionar"></i>
                </label>
                <input type="submit" id="submit" value="">
            </div>
        </div>
    </form>
    <h4 class="font-weight-normal mt-5">Últimos lembretes cadastrados</h4>
    <div  iv class=" bg-light rounded-3 shadow-sm my-3">
        <div class="row px-3 py-2">
            <div class="col-md-3">
                <div class="card card-reminder mb-3 border-0" style="max-width: 18rem;">
                    <div class="card-header border border-white">Header <small>10/12/1986</small></div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-reminder mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header <small>10/12/1986</small></div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-reminder mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header <small>10/12/1986</small></div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-reminder mb-3" style="max-width: 18rem;">
                    <div class="card-header">Header <small>10/12/1986</small></div>
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("templates/footer.php"); ?>

<script>
   
</script>