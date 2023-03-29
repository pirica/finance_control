<?php 
require_once("templates/header_iframe.php"); 
require_once("dao/FinancialMovimentDAO.php");
$financialMovimentDao = new FinancialMovimentDAO($conn, $BASE_URL);

$sql = "";
$output = "";
$total = 0;

if (isset($_POST['name_search_exit']) && $_POST['name_search_exit'] != '') {
    $name_search_exit = $_POST['name_search_exit'];
    $sql .= " AND description LIKE '%$name_search_exit%'";
}

if (isset($_POST['values_exit']) && $_POST['values_exit'] != '') {
    $values_exit = $_POST['values_exit'];
    $sql .= " AND value <= $values_exit";
}

if (isset($_POST['from_date_exit']) && $_POST['from_date_exit'] != '' && isset($_POST['to_date_exit']) && $_POST['to_date_exit'] != '') {
    $from_date_exit = $_POST['from_date_exit'];
    $to_date_exit = $_POST['to_date_exit'];
    $sql .= " AND create_at BETWEEN '$from_date_exit' AND '$to_date_exit 23:59:00'";
}

if (isset($_POST['category_exit']) && $_POST['category_exit'] != '') {
    $category_exit = $_POST['category_exit'];
    if($category_exit == 0){
        $sql .= " AND category > $category_exit";
    }else {
        $sql .= " AND category = $category_exit";
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
           
            $value = str_replace('.', '', $item->value);
            $total += (float) $value;
            $output .= '
            <tr>
                <th scope="row">'.$item->id.'</th>
                <td>'.$item->description.'</td>
                <td>'.$item->value.'</td>
                <td>'.$item->create_at.'</td>
                <td>'.$item->expense.'</td>
                <td>'.$item->category.'</td>
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
            <td colspan="8"> <strong> Total: R$</strong> '.number_format($total, 2, ',', '.').'</td>
        </tr>
        </tfoot>
    </table>';
    }else {
        echo "Nenhum registro encontrado, tente novamente";
    }
    
}

?>