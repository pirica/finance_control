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
            $popup->name = $data['name'];
            $popup->title = $data['title'];
            $popup->description = $data['description'];
            $popup->image = $data['image'];
            $popup->created_at = $data['created_at'];
            $popup->date_expired = $data['date_expired'];

            return $popup;
        }

        public function popup($id) {

            $stmt = $this->conn->prepare("SELECT popup.id, popup_name, title, description, image, created_at, date_expired FROM popup INNER JOIN popup_users ON popup.id  = popup_users.popup_id WHERE popup_users.show_popup = 'S' AND popup_users.status_visualized = 'N' AND popup_users.users_id = $id");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $popup = $this->buildPopup($data);

                return $popup;
            }
            
        }

        public function createWelcomePopup($users_id) {

            $stmt = $this->conn->prepare("INSERT INTO popup_users (
                popup_id, show_popup, status_visualized, users_id, created
            ) VALUES (
                1, 'S', 'N', :users_id, now()
            )");

            $stmt->bindParam(":users_id", $users_id);

            $stmt->execute();

        }

        public function createInfoPopup($users_id) {

            $stmt = $this->conn->prepare("INSERT INTO popup_users (
                popup_id, show_popup, status_visualized, users_id, created
            ) VALUES (
                2, 'N', 'N', :users_id, now()
            )");

            $stmt->bindParam(":users_id", $users_id);

            $stmt->execute();

        }

        public function updatePopupUser($popup_id, $users_id) {

            $stmt = $this->conn->prepare("UPDATE popup_users SET 
            show_popup = 'N', 
            status_visualized = 'S',
            modified = now() 
            WHERE popup_id = :popup_id AND users_id = :users_id 
            ");
            
            $stmt->bindParam(":popup_id", $popup_id);
            $stmt->bindParam(":users_id", $users_id);
            

            if($stmt->execute()) {
                $this->message->setMessage("", "", "back");
            }else {
                echo "error";
            }

        }

    }