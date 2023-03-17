<?php 

    Class Categorys {

        public $id;
        public $category_name;

    }

    interface CategorysDAOInterface {

        public function getAllEntryCategorys();
        public function getAllExitCategorys();
        public function buildCategorys($data);

    }