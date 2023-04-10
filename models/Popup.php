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

        public function buildPopup($data);
        public function welcomePopup($id);
        public function updateWelcomePopupUser($users_id);

    }
