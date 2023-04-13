<?php 

    Class Cards {

        public $id;
        public $card_holder;
        public $card_number;
        public $dt_expired;
        public $limit_value;
        public $available_limit;
        public $users_id;

    }

    interface CardsDAOINterface {
        public function buildCards($data);
        public function createCard(Cards $card);
        public function updateCard(Cards $card);
        public function deleteCard($id);
    }