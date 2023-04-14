<?php
require_once("globals.php");
require_once("connection/conn.php");
require_once("dao/CardsDAO.php");
require_once("dao/UserDAO.php");
require_once("models/Cards.php");
require_once("models/Message.php");

$cardsDao = new CardsDAO($conn, $BASE_URL);
$message = new Message($BASE_URL);

// resgata dados do usuário
$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken();



if ($_POST) {
    
    $card_holder = filter_input(INPUT_POST, "name_card");
    $card_number = filter_input(INPUT_POST, "cc");
    $dt_expired = filter_input(INPUT_POST, "expired_card");
    $limit_value = filter_input(INPUT_POST, "limit_value");
    $limit_value=preg_replace("/[^0-9,]+/i","",$limit_value);
    $limit_value=str_replace(",",".",$limit_value);
    $flag_card = "";

    $date = $dt_expired."-10 23:59:59";
    $date = date("Y-m-d H:i:s", strtotime($date));

    $_SESSION['name_card'] = $name_card;
    $_SESSION['card_number'] = $card_number;
    $_SESSION['expired_card'] = $expired_card;
    $_SESSION['limit_value'] = $limit_value;

    $flag_identity = substr($card_number, 0 , 2);

    if ($card_holder && $card_number && $dt_expired && $limit_value) {

        if($flag_identity == 34 || $flag_identity == 37) {
            $flag_card = "american_express";
        }else if($flag_identity == 36 || $flag_identity == 38) {
            $flag_card = "diners_club";
        }else if ($flag_identity >= 40 && $flag_identity <= 50) {
            $flag_card = "visa";
        }else if ($flag_identity >= 50 && $flag_identity <= 55) {
            $flag_card = "mastercard";
        }

        $card = new Cards();

        $card->card_holder = $card_holder;
        $card->card_number = $card_number;
        $card->dt_expired = $date;
        $card->limit_value = $limit_value;
        $card->flag_card = $flag_card;
        $card->users_id = $userData->id;

        try{
            $cardsDao->createCard($card);
            $_SESSION['name_card'] = "";
            $_SESSION['card_number'] = "";
            $_SESSION['expired_card'] = "";
            $_SESSION['limit_value'] = "";

        }catch (\PDOException $e){
            echo "Falha ao cadastrar o cartao : {$e->getMessage()}";
        }

    } else {
        $message->setMessage("Por favor preencha todos os campos.", "error", "back");
    }

}

?>