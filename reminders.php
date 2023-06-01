<?php
require_once("templates/header_iframe.php");
require_once("globals.php");
require_once("connection/conn.php");
require_once("dao/CardsDAO.php");

$cardDao = new CardsDAO($conn, $BASE_URL);

$cards = $cardDao->getAllCards($userData->id);

?>
<style>
    .reminder {
        display: flex;
        padding: 30px;
    }
    .flex-item {
        flex: 1 auto;
        margin: 0 30px;
    }
    .image, .button{flex: 0.5 auto;}
    .input1 {
        flex: 3 auto;
    }
    .input1,.input2 {margin-top:5px;}
    #file {display: none;}
   
</style>

<h1 class="text-center my-5">Meus Lembretes</h1>

<div class="container">
    <div class="reminder bg-light rounded-3 shadow-sm my-3">
        <div class="image flex-item">
            <label for="file">
                <i class="fa-solid fa-camera fa-3x"></i> 
            
            </label>
            <input type="file" id="file" name= "">
        </></div>
        <div class="input1 flex-item"> <input class="form-control "type="text" name="" id="" placeholder="ex: pagar conta de agua.."> </div>
        <div class="input2 flex-item"> <input class="form-control "type="date" name="" id=""></div>
        <div class="button flex-item"><i class="fa-regular fa-square-plus fa-3x"></i></div>
    </div>
</div>