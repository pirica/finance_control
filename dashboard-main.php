<?php require_once("templates/header_iframe.php"); ?>
<div class="container-fluid">

  <div class="card-deck mb-3 text my-5">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Receita Mensal</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title text-success">+ R$ 800,00 <small class="text-muted"></small>
        </h1>
        <!-- <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button> -->
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Despesa Mensal</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title text-danger">- R$ 600,00 <small class="text-muted"></small>
        </h1>
        <!-- <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button> -->
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Saldo Geral</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title text-success">+ R$ 200,00 <small class="text-muted"></small>
        </h1>
        <!-- <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button> -->
      </div>
    </div>
  </div>

  <div class="actions p-5 mb-4 bg-light rounded-3 shadow-sm">
    <form action="<?= $BASE_URL ?>amount_process.php" method="post">
      <input type="hidden" name="type" value="account_action">
      <div class="row">
        <div class="col-md-4">
          <h4 class="font-weight-normal">Descriçao</h4>
          <input type="text" name="description" id="description" class="form-control" placeholder="Insira uma descrição:" required>
        </div>
        <div class="col-md-4">
          <h4 class="font-weight-normal">Valor</h4>
          <input type="text" name="value" id="value" class="form-control" placeholder="Digite um valor:" required>
        </div>
        <div class="col-md-2 text-center">
          <h4 class="font-weight-normal">Tipo</h4>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type_action" id="inlineRadio1" value="entry" required>
            <label class="form-check-label" for="inlineRadio1">Entrada</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type_action" id="inlineRadio2" value="out" required>
            <label class="form-check-label" for="inlineRadio2">Saída</label>
          </div>
        </div>
        <div class="col-md-2 py-4">
          <input type="submit" class="btn btn-lg btn-success" value="Adicionar"></input>
        </div>
      </div>
    </form>
  </div>

  <div class="actions p-5 bg-light rounded-3 shadow-sm">
    <h4 class="font-weight-normal text-center">Últimas movimentações</h4>
    <hr class="dashed">
    <div class="row">
      <div class="col-md-4">
        <h4 class="font-weight-normal">Descriçao</h4>
      </div>
      <div class="col-md-4 text-center">
        <h4 class="font-weight-normal">Valor</h4>
      </div>
      <div class="col-md-4" style="text-align: end">
        <h4 class="font-weight-normal">Tipo</h4>
      </div>
    </div>
  </div>




  <?php require_once("templates/footer.php"); ?>