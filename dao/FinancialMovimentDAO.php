<?php 
    require_once("models/FinancialMoviment.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("models/Categorys.php");


    Class FinancialMovimentDAO implements FinancialMovimentDAOInterface {

        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url) {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }


        public function buildFinancialMoviment($data) {

            $financialMoviment = new FinancialMoviment();

            $financialMoviment->id = $data['id'];
            $financialMoviment->description = $data['description'];
            $financialMoviment->expense = $data['expense'];
            $financialMoviment->value = number_format($data['value'], 2, ',', '.');
            $financialMoviment->type = $data['type'];

            $category = $data['category'];

            switch($category):
                case 1:
                    $financialMoviment->category = "Educação";
                    break;
                case 2:
                    $financialMoviment->category = "Alimentação";
                    break;
                case 3:
                    $financialMoviment->category = "transporte";
                    break;
                case 4:
                    $financialMoviment->category = "Lazer";
                    break;
                case 5:
                    $financialMoviment->category = "Saúde";
                    break;
                case 6:
                    $financialMoviment->category = "Moradia";
                    break;
                case 7:
                    $financialMoviment->category = "Pessoal";
                    break;
                case 8:
                    $financialMoviment->category = "Outros";
                    break;
                case 9:
                    $financialMoviment->category = "Venda Produto|Serviço";
                    break;
                case 10:
                    $financialMoviment->category = "Salário";
                    break;
                case 11:
                    $financialMoviment->category = "Aluguel";
                    break;
                case 12:
                    $financialMoviment->category = "Devolução de Empréstimo";
                    break;
                case 13:
                    $financialMoviment->category = "Outros";
                    break;
            endswitch;

            $financialMoviment->users_id = $data["users_id"];
            $financialMoviment->create_at = $data['create_at'];
            // Alteração de formato de data para padrão Brasileiro
            $timestamp = strtotime($financialMoviment->create_at); 
            $newDate = date("d/m/Y H:i:s", $timestamp );
            $financialMoviment->create_at = $newDate;
            
            $financialMoviment->update_at = $data["update_at"];

            return $financialMoviment;
        }

        public function findAll() {

        }

        public function getHighValueIncome($id) {

            $highValueData = [];

            $stmt = $this->conn->query("SELECT MAX(VALUE) AS maior_valor, description FROM tb_finances WHERE TYPE= 1 AND users_id = $id GROUP BY value DESC LIMIT 1");
            $stmt->execute();
           
            $data = $stmt->fetchAll();

            foreach ($data as $row){
                $highValueData = $row["description"] . ": R$ " . number_format($row['maior_valor'], 2, ',', '.');
            }

             // Se não dados no BD recebe uma string padrão 
             if (empty($highValueData)) {
                $highValueData = "Não há dados registrados";
            }

            return $highValueData;

        }

        public function getLowerValueIncome($id) {

            $lowerValueData = [];

            $stmt = $this->conn->query("SELECT MIN(VALUE) AS menor_valor, description FROM tb_finances WHERE TYPE = 1 AND users_id = $id GROUP BY value ASC LIMIT 1");
            $stmt->execute();
           
            $data = $stmt->fetchAll();

            foreach ($data as $row){
                $lowerValueData = $row["description"] . ": R$ " . number_format($row['menor_valor'], 2, ',', '.');
            }
            
             // Se não dados no BD recebe uma string padrão 
             if (empty($lowerValueData)) {
                $lowerValueData = "Não há dados registrados";
            }

            return $lowerValueData;

        }

        public function getBiggestExpense($id) {

            $biggestValueData = [];

            $stmt = $this->conn->query("SELECT MAX(VALUE) AS maior_valor, description FROM tb_finances WHERE TYPE = 2 AND users_id = $id GROUP BY value DESC LIMIT 1");
            $stmt->execute();
           
            $data = $stmt->fetchAll();

            foreach ($data as $row){
                $biggestValueData = $row["description"] . ": R$ " . number_format($row['maior_valor'], 2, ',', '.');
            }
            
            // Se não dados no BD recebe uma string padrão 
            if (empty($biggestValueData)) {
                $biggestValueData = "Não há dados registrados";
            }

            return $biggestValueData;

        }

        public function getLowerExpense($id) {

            $lowerValueData = [];

            $stmt = $this->conn->query("SELECT MIN(VALUE) AS menor_valor, description FROM tb_finances WHERE TYPE = 2 AND users_id = $id GROUP BY value ASC LIMIT 1");
            $stmt->execute();
           
            $data = $stmt->fetchAll();

            foreach ($data as $row){
                $lowerValueData = $row["description"] . ": R$ " . number_format($row['menor_valor'], 2, ',', '.');
            }

             // Se não dados no BD recebe uma string padrão 
            if (empty($lowerValueData)) {
                $lowerValueData = "Não há dados registrados";
            }

            return $lowerValueData;

        }

        public function getLatestFinancialMoviment($id) {
            
            $financialMoviments = [];

            $stmt = $this->conn->query("SELECT * FROM tb_finances WHERE users_id = $id ORDER BY id DESC LIMIT 5");

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                
                $financialMovimentsArray = $stmt->fetchAll();

                foreach ($financialMovimentsArray as $financialMoviment){

                    $financialMoviments[] = $this->buildFinancialMoviment($financialMoviment);
                
                }
            }
            return $financialMoviments;
        }


        public function getAllCashInflow($id) {

            // Pega mês atual
            $mes = date('m');

            $stmt = $this->conn->query("SELECT SUM(value) as sum FROM tb_finances WHERE MONTH(create_at) = '$mes' AND users_id = $id AND type = 1");
            $stmt->execute();
            $row = $stmt->fetch();

            $sum = number_format($row['sum'], 2, ',', '.');

            return $sum;

        }

        public function getAllCashOutflow($id) {

            // Pega mês atual
            $mes = date('m');

            $stmt = $this->conn->query("SELECT SUM(value) as sum FROM tb_finances WHERE MONTH(create_at) = '$mes' AND users_id = $id AND type = 2");
            $stmt->execute();
            $row = $stmt->fetch();

            $sum = number_format($row['sum'], 2, ',', '.');

            return $sum;

        }

        public function getTotalBalance($id) {

            // Pega mês atual
            $mes = date('m');

            $stmt = $this->conn->query("SELECT (SELECT SUM(value) FROM tb_finances WHERE MONTH(create_at) = '$mes' AND users_id = $id AND TYPE = 1) - (SELECT SUM(value) FROM tb_finances WHERE MONTH(create_at) = '$mes' AND users_id = $id AND TYPE = 2) AS total_balance");
            $stmt->execute();
            $row = $stmt->fetch();

            $total_balance = number_format($row['total_balance'], 2, ',', '.');

            return $total_balance;

        }

        public function getCashInflowReport($monthy) {

        }

        public function getCashOutFlowReport($monthy) {

        }

        public function findById($id) {

        }

        public function create(FinancialMoviment $financialMoviment) {

            $stmt = $this->conn->prepare("INSERT INTO tb_finances (
                id, description, value, type, expense, category, create_at, users_id
            ) VALUES(
                :id, :description, :value, :type, :expense, :category, now(), :users_id
            )");

            $stmt->bindParam(':id', $financialMoviment->id);
            $stmt->bindParam(':description', $financialMoviment->description);
            $stmt->bindParam(':value', $financialMoviment->value);
            $stmt->bindParam(':type', $financialMoviment->type);
            $stmt->bindParam(':expense', $financialMoviment->expense);
            $stmt->bindParam(':category', $financialMoviment->category);
            $stmt->bindParam(':users_id', $financialMoviment->users_id);
            
            if($stmt->execute()):
                // Salva também na tabela de históricos 
                $stmt = $this->conn->prepare("INSERT INTO tb_finances_historic (
                    id, description, value, type, expense, category, create_at, users_id
                ) VALUES(
                    :id, :description, :value, :type, :expense, :category, now(), :users_id
                )");
    
                $stmt->bindParam(':id', $financialMoviment->id);
                $stmt->bindParam(':description', $financialMoviment->description);
                $stmt->bindParam(':value', $financialMoviment->value);
                $stmt->bindParam(':type', $financialMoviment->type);
                $stmt->bindParam(':expense', $financialMoviment->expense);
                $stmt->bindParam(':category', $financialMoviment->category);
                $stmt->bindParam(':users_id', $financialMoviment->users_id);
                $stmt->execute();

            endif;
            
            $type_moviment = "";

            $financialMoviment->type = 1 ? $type_moviment = "Entrada" : $type_moviment = "Saída";

            $this->message->setMessage("$type_moviment registrada com sucesso!", "success", "back");

        }

        public function update(FinancialMoviment $financialMoviment) {

            $stmt = $this->conn->prepare("UPDATE tb_finances SET
                description = :description,
                value = :value,
                expense = :expense,
                category = :category,
                update_at = now() 
                WHERE id = :id
             ");

             $stmt->bindParam(":description", $financialMoviment->description);
             $stmt->bindParam(":value", $financialMoviment->value);
             $stmt->bindParam(":expense", $financialMoviment->expense);
             $stmt->bindParam(":category", $financialMoviment->category);
             $stmt->bindParam(":id", $financialMoviment->id);

             if($stmt->execute()) {
                $this->message->setMessage("Registro alterado com sucesso!", "success", "back");
             }

        }

        public function destroy($id) {

            // Checa se existe id
            if ($id) {
                
                $stmt = $this->conn->prepare("DELETE FROM tb_finances WHERE id = :id");
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    $this->message->setMessage("Registro excluído com sucesso!", "success", "back");
                }

            }

        }

    }