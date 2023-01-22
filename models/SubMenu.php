<?php

Class SubMenu {
        
    private $id;
    private $id_main_menu;
    private $class_icon_subMenu;
    private $url;
    private $subMenu_name;

    public function getIdSubMenu(){
        return $this->id;
    }

    public function setIdSubMenu($idSubMenu) {
        $this->id = $idSubMenu;
    }

    public function getIdMainMenu(){
        return $this->id_main_menu;
    }

    public function setIdMainMenu($idMainMenu) {
        $this->id = $idMainMenu;
    }

    public function getClassIconSubMenu(){
        return $this->class_icon_subMenu;
    }

    public function setClassIconSubMenu($classIconSubMenu) {
        $this->class_icon_subMenu = $classIconSubMenu;
    }

    public function getUrlSubMenu(){
        return $this->url;
    }

    public function setUrlSubMenu($urlSubMenu) {
        $this->url = $urlSubMenu;
    }

    public function getIdSubMenuName(){
        return $this->subMenu_name;
    }

    public function setSubMenuName($subMenuName) {
        $this->subMenu_name = $subMenuName;
    }
}

interface SubMenuDAOInterface{
    public function findSubMenus(int $id);
}