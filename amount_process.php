<?php

require_once("globals.php");
require_once("connection/conn.php");
require_once("dao/FinancialMovimentDAO.php");
require_once("dao/UserDAO.php");
require_once("models/FinancialMoviment.php");
require_once("models/Message.php");

$financialMovimentDao = new FinancialMovimentDAO($conn, $BASE_URL);
$message = new Message($BASE_URL);

// resgata dados do usuário
$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken();

if ($_POST) {
    
    $description = filter_input(INPUT_POST, "description");
    $value = filter_input(INPUT_POST, "value");
    $type_action = filter_input(INPUT_POST, "type_action");
    $expense_type = filter_input(INPUT_POST, "expense_type");

    $financialMoviment = new FinancialMoviment();

    if ($description && $value && $type_action) {

        if ($type_action == 2) {
               
            if (empty($expense_type)) {
                 // Informa que o campo Despesa precisa ser preenchido
                 $message->setMessage("Para o tipo Saída, preencha também o campo despesa!", "error", "back");
            }
            exit;       
        }

        $financialMoviment->description = $description;
        $financialMoviment->value = $value;
        $financialMoviment->type = $type_action;
        $financialMoviment->expense = $expense_type;
        $financialMoviment->users_id = $userData->id;

        $financialMovimentDao->create($financialMoviment);

    }else {
        $message->setMessage("Preencha os campos descrição, valor e tipo!", "error", "back");
    }


}