<?php 

    Class Categorys {

        public $id;
        public $category_name;

    }

    interface CategorysDAOInterface {

        public function getAllCategorys();
        public function buildCategorys($data);

    }