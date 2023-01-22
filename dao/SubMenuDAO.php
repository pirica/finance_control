<?php
require_once("models/SubMenu.php");

Class SubMenuDAO implements SubMenuDAOInterface {

    private $conn;
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }


    public function findSubMenus(int $id) {
        $subMenus = [];

        $stmt = $this->conn->query("SELECT * from submenu WHERE id_main_menu = $id");
        $data = $stmt->fetchAll();

        foreach($data as $item){
            $sub_menu = new SubMenu();

            $sub_menu->setIdSubMenu($item['id']);
            $sub_menu->setIdMainMenu($item['id_main_menu']);
            $sub_menu->setClassIconSubMenu($item['class_icon']);
            $sub_menu->setUrlSubMenu($item['url']);
            $sub_menu->setSubMenuName($item['menu_name']);

            array_push($subMenus, $sub_menu);
        }

        return $subMenus;
    }
}