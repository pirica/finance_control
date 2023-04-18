<?php
require_once("globals.php");
require_once("models/Cards.php");
require_once("models/User.php");
require_once("models/Message.php");


    Class CardsDAO implements CardsDAOINterface {

        private $conn;
        private $message;
        private $url;

        public function __construct(PDO $conn, $url) {
            $this->conn = $conn;
            $this->message = new Message($url);
            $this->url = $url;
        }

        public function buildCards($data) {

            $card = new Cards();

            $card->id = $data['id'];
            $card->card_holder = $data['card_holder'];
            $card->card_number = $data['card_number'];
            $card->flag_card = $data['flag_card'];
            $card->flag_icon = $data['flag_icon'];
            $card->dt_expired = date('Y-m', strtotime($data['dt_expired']));
            $card->limit_value =  number_format($data['limit_value'], 2, ',', '.');
            $card->available_limit = $data['available_limit'];
            $card->users_id = $data['users_id'];

            return $card;
        }

        public function getAllCards($data) {
           
            $cards = [];

            $stmt =  $this->conn->prepare("SELECT * FROM cards WHERE users_id = :id");
            $stmt->bindParam(':id', $data);

            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $cardsArray = $stmt->fetchAll();

                foreach($cardsArray as $card) {
                    $cards[] = $this->buildCards($card);
                }
            }

            return $cards;

        }

        public function createCard(Cards $card) {

            $stmt = $this->conn->prepare("INSERT INTO cards (
            id, card_holder, card_number, flag_card, flag_icon, dt_expired, limit_value, users_id
            ) VALUES (
                :id, :card_holder, :card_number, :flag_card, :flag_icon, :dt_expired, :limit_value, :users_id
            )");

            $stmt->bindParam(':id', $card->id);
            $stmt->bindParam(':card_holder', $card->card_holder);
            $stmt->bindParam(':card_number', $card->card_number);
            $stmt->bindParam(':flag_card', $card->flag_card);
            $stmt->bindParam(':flag_icon', $card->flag_icon);
            $stmt->bindParam(':dt_expired', $card->dt_expired);
            $stmt->bindParam(':limit_value', $card->limit_value);
            $stmt->bindParam(':users_id', $card->users_id);

            if($stmt->execute()) {
                $this->message->setMessage("Cartão inserido com sucesso!", "success", "back");
            }

        }
        public function updateCard(Cards $card) {

        }
        public function destroyCard($id) {

             // Checa se existe id
             if ($id) {
                
                $stmt = $this->conn->prepare("DELETE FROM cards WHERE id = :id");
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    $this->message->setMessage("Cartão excluído com sucesso!", "success", "back");
                }

            }

        }

        
    }