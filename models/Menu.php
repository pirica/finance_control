<?php 

    Class Menu {
        private $id_menu;
        private $class_icon;
        private $url;
        private $sub_menu;
        private $menu_name;


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
    }


    interface MenuDAOInterface{
        public function findAll(); 
    }
