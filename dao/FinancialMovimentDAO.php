<?php 
    require_once("models/FinancialMoviment.php");
    require_once("models/Message.php");


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
            $financialMoviment->value = $data['value'];
            $financialMoviment->type = $data['type'];
            $financialMoviment->users_id = $data["users_id"];
            $financialMoviment->create_at = $data['create_at'];
            $financialMoviment->update_at = $data["update_at"];

            return $financialMoviment;
        }

        public function findAll() {

        }

        public function getLatestFinancialMoviment() {

        }

        public function getEntrysReport($monthy) {

        }

        public function getOutReport($monthy) {

        }

        public function findById($id) {

        }

        public function create(FinancialMoviment $financialMoviment) {

            $stmt = $this->conn->prepare("INSERT INTO tb_finances (
                id, description, value, type, expense, create_at, users_id
            ) VALUES(
                :id, :description, :value, :type, :expense, now(), :users_id
            )");

            $stmt->bindParam(':id', $financialMoviment->id);
            $stmt->bindParam(':description', $financialMoviment->description);
            $stmt->bindParam(':value', $financialMoviment->value);
            $stmt->bindParam(':type', $financialMoviment->type);
            $stmt->bindParam(':expense', $financialMoviment->expense);
            // $stmt->bindParam(':create_at', $financialMoviment->create_at);
            $stmt->bindParam(':users_id', $financialMoviment->users_id);
            
            $stmt->execute();
            
            $type_moviment = "";

            switch($financialMoviment->type):
                case 1:
                    $type_moviment = "Entrada";
                    break; 
                case 2:
                    $type_moviment = "Saída";
            endswitch;

            $this->message->setMessage("$type_moviment registrada com sucesso!", "success", "back");

        }

        public function update(FinancialMoviment $financialMoviment) {

        }

        public function destroy($id) {

        }

    }