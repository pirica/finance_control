<?php
require_once("templates/header_iframe.php");
require_once("globals.php");
require_once("connection/conn.php");
require_once("dao/CardsDAO.php");

$cardDao = new CardsDAO($conn, $BASE_URL);

$cards = $cardDao->getAllCards($userData->id);

?>

<div class="container-fluid">
    <h1 class="text-center my-5 text-secondary">Meus Cartões</h1>

    <!-- Each Card  -->
    <div class="card_example" id="cards-page">
        <div class="row">
        
            <?php foreach($cards as $card): ?>
            <div class="col-md-4  my-3">
                <div class="card-credit bg-secondary <?= $card->flag_card ?>" id="card-credit-bg">
                    <div class="card_logo">
                
                        <div id="flag_icon" class="<?= $card->flag_icon ?>" alt=""></div>

                        <div class="card_info">
                            <img src="<?= $BASE_URL ?>assets/home/dashboard-main/chip.png" alt="">
                            <p class="mt-3" id="card_number"><?= $card->card_number ?></p>
                        </div>

                        <div class="card_crinfo">
                            <p id="card_name">
                                <?= $card->card_holder ?>
                            </p>

                            <div class="form-group">
                                <small class="text-light">Expira</small>
                                <p id="expired_date"><?= $card->dt_expired ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="text-center my-2">
                        <p>Limíte de crédito R$<?=$card->limit_value?> </p>
                        <!-- <a href="#" data-toggle="modal" data-target="#exampleModalCenter" title="Editar">
                            <i class="fa-solid fa-file-pen"></i>
                        </a> -->
                        <!-- <form action="<?= $BASE_URL ?>cards_process.php?id_card=<?= $card->id ?>" method="post"> -->
                        <a href="<?= $BASE_URL ?>cards_process.php?id_card=<?= $card->id ?>" title="Deletar">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                        <!-- </form> -->
                       
                    </div>
            </div>
            <?php endforeach;?>

            <?php if(count($cards) === 0): ?>
                <h4 class="col text-center">Nenhuma Cartão cadastrado</h4>
            <?php endif; ?>
       
        </div>
    </div>
     <!-- Each Card  -->
</div>
<?php require_once("templates/footer.php"); ?>