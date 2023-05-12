<?php 

    Class Popup {
        public $id;
        public $title;
        public $description;
        public $image;
        public $show_popup;
        public $created_at;
        public $date_expired;
    }

    interface PopupDAOInterface {

        public function buildPopup($data); // controi objeto popup
        public function welcomePopup($users_id); // traz dados popup welcome
        public function infoPopup($users_id); // traz dados info popup
        public function createPopup($users_id); // insere popup welcome para usuários novos
        public function updateWelcomePopupUser($users_id); // atualiza status popup welcome para usuário 
        public function updateInfoPopupUser($users_id); // atualiza status popup info para usuário 

    }
