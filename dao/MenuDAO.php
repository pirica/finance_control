<?php 
require_once("models/Menu.php");

Class MenuDAO implements MenuDAOInterface{

    private $conn;
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function findMenu() {
        $menus = [];

        $stmt = $this->conn->query("SELECT idmenu, class_icon, sub_menu, url, menu_name FROM menu WHERE menu_name IS NOT NULL");
        $data = $stmt->fetchAll();

        foreach($data as $item){
            $menu = new Menu();

            $menu->setIdMenu($item['idmenu']);
            $menu->setClassIcon($item['class_icon']);
            $menu->setUrl($item['url']);
            $menu->setSubMenu($item['sub_menu']);
            $menu->setMenuName($item['menu_name']);

            array_push($menus, $menu);
        }

        return $menus;
    }

    public function findSubMenu(int $id) {
        $subMenus = [];
        //SELECT id_submenu, main_menu_id, class_icon_submenu, url_submenu, submenu_name FROM menu WHERE submenu_name IS NOT NULL;
        $stmt = $this->conn->query("SELECT id_submenu, main_menu_id, class_icon_submenu, url_submenu, submenu_name FROM menu WHERE main_menu_id = $id");
        $data = $stmt->fetchAll();

        foreach($data as $item){
            $sub_menu = new Menu();

            $sub_menu->setIdSubMenu($item['id_submenu']);
            $sub_menu->setMainMenuId($item['main_menu_id']);
            $sub_menu->setClassIconSubMenu($item['class_icon_submenu']);
            $sub_menu->setUrlSubMenu($item['url_submenu']);
            $sub_menu->setSubMenuName($item['submenu_name']);

            array_push($subMenus, $sub_menu);
        }

        return $subMenus;
    }

}   
