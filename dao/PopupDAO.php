<?php

require_once("models/Popup.php");
require_once("models/User.php");

    Class PopupDAO implements PopupDAOInterface {

        private $conn;
        private $url;

        public function __construct(PDO $conn) {
            $this->conn = $conn;
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

        public function findById($id) {

            $stmt = $this->conn->prepare("SELECT title, description, image, created_at, date_expired FROM popup INNER JOIN popup_users ON popup.id  = popup_users.id_welcome_popup WHERE popup_users.show_welcome_popup = 'S' AND popup_users.users_id = $id");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $popup = $this->buildPopup($data);

                return $popup;
            }
            
        }

    }