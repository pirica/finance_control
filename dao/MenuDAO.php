<?php 
require_once("models/Menu.php");

Class MenuDAO implements MenuDAOInterface{

    private $conn;
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function findAll() {
        $menus = [];

        $stmt = $this->conn->query("SELECT * from menu");
        $data = $stmt->fetchAll();

        foreach($data as $item){
            $menu = new Menu();

            $menu->setIdMenu($item['idmenu']);
            $menu->setClassIcon($item['class_icon']);
            $menu->setUrl($item['url']);
            $menu->setSubMenu($item['sub-menu']);
            $menu->setMenuName($item['menu_name']);

            array_push($menus, $menu);
        }

        return $menus;
    }

}   
