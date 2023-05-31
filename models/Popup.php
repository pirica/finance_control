<?php 

    Class Popup {
        public $id;
        public $name;
        public $title;
        public $description;
        public $image;
        public $show_popup;
        public $created_at;
        public $date_expired;
    }

    interface PopupDAOInterface {

        public function buildPopup($data); // controi objeto popup
        public function popup($users_id); // traz dados popup welcome
        public function createWelcomePopup($users_id); // insere popup welcome para usuários novos
        public function createInfoPopup($users_id); // insere popup welcome para usuários novos
        public function updatePopupUser($pop_id, $users_id); // atualiza status popup welcome para usuário 

    }
