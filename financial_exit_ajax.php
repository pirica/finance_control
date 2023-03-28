<?php 
require_once("templates/header_iframe.php"); 
require_once("dao/FinancialMovimentDAO.php");
$financialMovimentDao = new FinancialMovimentDAO($conn, $BASE_URL);

$sql = "";
$output = "";
$total = 0;

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
    if($category == 0){
        $sql .= " AND category > $category";
    }else {
        $sql .= " AND category = $category";
    }
}

// Traz o array com os dados da query personalizada 
$getOutReports = $financialMovimentDao->getReports($sql, 2, $userData->id);

if (!empty($sql)) {
   
    if ($getOutReports != null) {
        $output .= '<table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Data</th>
                <th scope="col">Despesa</th>
                <th scope="col">Categoria</th>
                <th scope="col">Observação</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>';
    
        foreach($getOutReports as $item) {
            $expense_type = $item->expense;
            $expense_type == "V" ? $expense_type = "Variada" : $expense_type = "Fixa"; 
            $category = $item->category;
           
            $total += (float)$item->value;
            $output .= '
            <tr>
                <th scope="row">'.$item->id.'</th>
                <td>'.$item->description.'</td>
                <td>'.$item->value.'</td>
                <td>'.$item->create_at.'</td>
                <td>'.$expense_type.'</td>
                <td>'.$category.'</td>
                <td>obs</td>
                <td id="latest_moviments"><a href="#" data-toggle="modal"
                    data-target="#exampleModalCenter'.$item->id.'" title="Editar">
                    <i class="fa-solid fa-file-pen"></i></a>
                <a href="#" data-toggle="modal" data-target="#modal_del_finance_moviment'.$item->id.'"
                        title="Deletar"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            ';
        }
        echo $output . '
        <tfoot>
        <tr>
            <td colspan="8"> <strong> Total: </strong> '.number_format($total, 2, ',', '.').'</td>
        </tr>
        </tfoot>
    </table>';
    }else {
        echo "Nenhum registro encontrado, tente novamente";
    }
    
}

?>