<?php require_once("templates/header.php"); ?>
<?php require_once("connection/conn.php"); ?>
<div class="container-fluid">
<h1>Dashboard</h1>


  <div class="card-deck mb-3 text">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Receita Mensal</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title text-success">R$ 800,00 <small class="text-muted"></small></h1>
        <!-- <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button> -->
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Despesa Mensal</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title text-danger">R$ 600,00 <small class="text-muted"></small></h1>
        <!-- <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button> -->
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Saldo Geral</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title text-success">R$ 200,00 <small class="text-muted"></small></h1>
        <!-- <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button> -->
      </div>
    </div>
  </div>



  <?php require_once("templates/footer.php"); ?>