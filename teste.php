<?php

$localhost = 'localhost';
$user = 'root';
$db = "finance_db";
$psw = "";
$conn = new PDO("mysql:host=$localhost;dbname=$db", $user, $psw);

/* 
Script para caso o usuário tenha se cadastrado após janeiro
As entradas e saídas que antecedem o mês atual do sistema seja
Sejam preenchidos com 0 para o perfeito funcionamento do gráfico anual 
*/

$ano = date("Y");
$m = date("m");
$m = intval($m);

for($mes = $m; $mes > 0; $mes--):

    # -------------- Entradas ------------------------- #
    // Query a partir do mês atual em forma descrente ex: 03, 02, 01
    $stmt = $conn->query("SELECT SUM(value) as sum FROM tb_finances WHERE MONTH(create_at) = $mes AND users_id = 15 AND TYPE = 1");
    $stmt->execute();
    $entradas = $stmt->fetchAll();

    // Itera o array que vem do BD checando a soma de entradas em cada mês
    foreach ($entradas as $row){
        $value_entradas = $row["sum"];
       echo "entrada ";
        // Se o array retornar vazio (null) neste Mês não há registros
        // Então insere um registro padrão com valor 0
        if (!$value_entradas == null || !empty($value_entradas)) {
            echo "mes $mes possui valor <br>";
        }else {
             echo "mes $mes não possui valor <br>";
            $stmt = $conn->prepare("INSERT INTO tb_finances (
                description, value, type, create_at, users_id
            ) VALUES(
                :description, :value, :type, :create_at, :users_id
            )");
            $description = "Não houve registros nesse mês";
            $value = 1;
            $users_id = 15;
            $type = 1;
            $create_at = "$ano-$mes-10 10:00:10";

            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':value', $value);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':create_at', $create_at);
            $stmt->bindParam(':users_id', $users_id);

            $stmt->execute();

        }
    }

     #-------------------- Saídas ------------------------------------#
     $stmt = $conn->query("SELECT SUM(value) as sum FROM tb_finances WHERE MONTH(create_at) = $mes AND users_id = 15 AND TYPE = 2");
     $stmt->execute();
     $saidas = $stmt->fetchAll();
     
     foreach ($saidas as $row){
         $value_saidas = $row["sum"];
        echo "Saida ";
         // Se o array retornar vazio (null) neste Mês não há registros
         // Então insere um registro padrão com valor 0
         if (!$value_saidas == null || !empty($value_saidas)) {
             echo "mes $mes possui valor <br>";
         }else {
             echo "mes $mes não possui valor <br>";
             $stmt = $conn->prepare("INSERT INTO tb_finances (
                 description, value, type, create_at, users_id
             ) VALUES(
                 :description, :value, :type, :create_at, :users_id
             )");
             $description = "Não houve registros nesse mês";
             $value = 1;
             $users_id = 15;
             $type = 2;
             $create_at = "$ano-$mes-10 10:00:10";
 
             $stmt->bindParam(':description', $description);
             $stmt->bindParam(':value', $value);
             $stmt->bindParam(':type', $type);
             $stmt->bindParam(':create_at', $create_at);
             $stmt->bindParam(':users_id', $users_id);
 
             $stmt->execute();
         }
     }
     echo "<br>";
endfor;

