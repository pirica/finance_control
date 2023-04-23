<?php 
require_once("models/Menu.php");

Class MenuDAO implements MenuDAOInterface{

    private $conn;
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function buildMenu($data){

        $menu = new Menu();

        $menu->id_menu = $data['idmenu'];
        $menu->class_icon = $data['class_icon'];
        $menu->url = $data['url'];
        $menu->sub_menu = $data['sub_menu'];
        $menu->menu_name = $data['menu_name'];
        $menu->show_item = $data['show_item'];
        $menu->id_submenu = $data['id_submenu'];
        $menu->main_menu_id = $data['main_menu_id'];
        $menu->class_icon_submenu = $data['class_icon_submenu'];
        $menu->url_submenu = $data['url_submenu'];
        $menu->submenu_name = $data['submenu_name'];

        return $menu;
    }

    public function findMenu() {
        $menus = [];

        $stmt = $this->conn->query("SELECT idmenu, class_icon, sub_menu, url, menu_name FROM menu WHERE menu_name IS NOT NULL AND show_item = 'S'");        
        $stmt->execute();
       

        if ($stmt->rowCount() > 0) {

            $data = $stmt->fetchAll();
            
            foreach ($data as $item_menu){
                // echo "entrou no for"; exit;

                $menus[] = $this->buildMenu($item_menu);
                
            }
            return $menus;
    
        }

    }

    public function findSubMenu(int $id) {
        $subMenus = [];
        //SELECT id_submenu, main_menu_id, class_icon_submenu, url_submenu, submenu_name FROM menu WHERE submenu_name IS NOT NULL;
        $stmt = $this->conn->query("SELECT id_submenu, main_menu_id, class_icon_submenu, url_submenu, submenu_name FROM menu WHERE main_menu_id = $id");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // echo "retornou"; exit;
            $data = $stmt->fetchAll();

            foreach ($data as $item_menu){
                $subMenus[] = $this->buildMenu($item_menu);
            }
           
        }
        return $subMenus;

    }

}   
