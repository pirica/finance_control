<?php

$type = filter_input(INPUT_POST, "type");

if ($type == "account_action") {
    echo "entrou no process <br>";
    print_r($_POST); exit;
}