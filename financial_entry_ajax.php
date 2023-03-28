<?php 
require_once("templates/header_iframe.php"); 
require_once("dao/FinancialMovimentDAO.php");
$financialMovimentDao = new FinancialMovimentDAO($conn, $BASE_URL);

$sql = "";
$output = "";
$total = 0;
$user_id = $_POST['user_id'];

if (isset($_POST['name_search']) && $_POST['name_search'] != '') {
    $name_search = $_POST['name_search'];
    $sql .= " AND description LIKE '%$name_search%'";
}

if (isset($_POST['values']) && $_POST['values'] != '') {
    $values = $_POST['values'];
    $sql .= " AND value <= $values";
}

if (isset($_POST['from_date']) && $_POST['from_date'] != '' && isset($_POST['to_date']) && $_POST['to_date'] != '') {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $sql .= " AND create_at BETWEEN '$from_date' AND '$to_date'";
}

if (isset($_POST['category']) && $_POST['category'] != '') {
    $category = $_POST['category'];
    $sql .= " AND category = $category";
}

if (!empty($sql)) {
    $stmt = $conn->query("SELECT id, description, value, category, create_at, users_id FROM tb_finances WHERE users_id = $user_id AND type = 1 AND category IS NOT NULL $sql");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $output .= '<table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Data</th>
                <th scope="col">Categoria</th>
                <th scope="col">Observação</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>';
    
        $data = $stmt->fetchAll();
    
        foreach($data as $item) {
            $total += $item["value"];
            $output .= '
            <tr>
                <th scope="row">'.$item["id"].'</th>
                <td>'.$item["description"].'</td>
                <td>'.$item["value"].'</td>
                <td>'.$item["create_at"].'</td>
                <td>'.$item["category"] . '</td>
                <td>obs</td>
                <td>Editar | Excluir</td>
            </tr>
            ';
        }
        echo $output . '
        <tfoot>
        <tr>
            <td colspan="7"> <strong> Total: </strong> '.$total.'</td>
        </tr>
        </tfoot>
    </table>';
    }else {
        echo "Nenhum registro encontrado, tente novamente";
    }
    
}

?>