<?php 
require_once("models/Categorys.php");
    Class CategorysDAO implements CategorysDAOInterface{

        private $conn;

        public function __construct(PDO $conn){
            $this->conn = $conn;
        }
        
        public function getAllCategorys() {
            $categorys = [];

            $stmt = $this->conn->query("SELECT * FROM finance_categorys");

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                
                $cateogrysArray = $stmt->fetchAll();

                foreach ($cateogrysArray as $category){

                    $categorys[] = $this->buildCategorys($category);
                
                }
            }
            return $categorys;
        }

        public function buildCategorys($data) {

            $categorys = new Categorys();

            $categorys->id = $data['id'];
            $categorys->category_name = $data['category_name'];

            return $categorys;
        }
        
    }