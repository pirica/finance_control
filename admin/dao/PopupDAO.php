<?php

require_once("models/Popup.php");
require_once("models/User.php");
require_once("models/Message.php");

    Class PopupDAO implements PopupDAOInterface {

        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url) {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }


        public function buildPopup($data) {

            $popup = new Popup();

            $popup->id = $data['id'];
            $popup->title = $data['title'];
            $popup->description = $data['description'];
            $popup->image = $data['image'];
            $popup->created_at = $data['created_at'];
            $popup->date_expired = $data['date_expired'];

            return $popup;
        }

        public function welcomePopup($id) {

            $stmt = $this->conn->prepare("SELECT title, description, image, created_at, date_expired FROM popup INNER JOIN popup_users ON popup.id  = popup_users.id_welcome_popup WHERE popup_users.show_welcome_popup = 'S' AND popup_users.users_id = $id");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $popup = $this->buildPopup($data);

                return $popup;
            }
            
        }

        public function updateWelcomePopupUser($users_id) {

            $stmt = $this->conn->prepare("UPDATE popup_users SET 
            show_welcome_popup = 'N', 
            welcome_status = 'S' 
            WHERE users_id = :id
            ");

            $stmt->bindParam(":id", $users_id);


            if($stmt->execute()) {
                $this->message->setMessage("Seja bem vindo", "success", "back");
            }else {
                echo "error";
            }

        }

    }