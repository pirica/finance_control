<?php 

    Class Menu {
        private $id_menu;
        private $class_icon;
        private $url;
        private $sub_menu;
        private $menu_name;
        private $id_submenu;
        private $main_menu_id;
        private $class_icon_submenu;
        private $url_submenu;
        private $submenu_name;


        public function getIdMenu() {
            return $this->id_menu;
        }

        public function setIdMenu($id_menu) {
            $this->id_menu = $id_menu;
            return $this;
        }

        public function getClassIcon() {
            return $this->class_icon;
        }

        public function setClassIcon($class_icon) {
            $this->class_icon = $class_icon;
            return $this;
        }

        public function getUrl() {
            return $this->url;
        }

        public function setUrl($url) {
            $this->url = $url;
            return $this;
        }

        public function getSubMenu() {
            return $this->sub_menu;
        }

        public function setSubMenu($subMenu) {
            $this->sub_menu = $subMenu;
            return $this;
        }

        public function getMenuName() {
            return $this->menu_name;
        }

        public function setMenuName($menu_name) {
            $this->menu_name = $menu_name;
            return $this;
        }

        public function getIdSubMenu() {
            return $this->id_submenu;
        }

        public function setIdSubMenu($id_submenu) {
            $this->id_submenu = $id_submenu;
            return $this;
        }

        public function getMainMenu_Id() {
            return $this->main_menu_id;
        }

        public function setMainMenuId($main_menu_id) {
            $this->main_menu_id = $main_menu_id;
            return $this;
        }

        public function getClassIconSubMenu() {
            return $this->class_icon_submenu;
        }

        public function setClassIconSubMenu($class_icon_submenu) {
            $this->class_icon_submenu = $class_icon_submenu;
            return $this;
        }

        public function getUrlSubMenu() {
            return $this->url_submenu;
        }

        public function setUrlSubMenu($url_submenu) {
            $this->url_submenu = $url_submenu;
            return $this;
        }

        public function getSubMenuName() {
            return $this->submenu_name;
        }

        public function setSubMenuName($submenu_name) {
            $this->submenu_name = $submenu_name;
            return $this;
        }

    }


    interface MenuDAOInterface{
        public function findMenu(); 
        public function findSubMenu(int $id); 
    }
