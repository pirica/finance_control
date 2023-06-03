<?php 
    require_once("models/Reminders.php");
    require_once("globals.php");
    require_once("models/Message.php");


    class RemindersDAO implements RemindersDAOInterface {

        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url) {
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildReminder($data){

            $reminder = new Reminders();

            $reminder->id = $data['id'];
            $reminder->title = $data['title'];
            $reminder->description = $data['description'];
            $reminder->reminder_date = date("d-m-Y", strtotime($data['reminder_date']));
            $reminder->users_id = $data['users_id'];
            $reminder->created = $data['created'];
            $reminder->modified = $data['modified'];
            
            return $reminder;

        }

        public function getAllReminders($data){

            $reminders = [];

            $stmt = $this->conn->prepare("SELECT 
            id, title, description, reminder_date, users_id, created, modified 
            FROM tb_reminders 
            WHERE users_id = :users_id 
            ORDER BY reminder_date ASC");
            $stmt->bindParam(":users_id", $data);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                
                $data = $stmt->fetchAll();
                
                foreach($data as $reminder) {
                    $reminders[] = $this->buildReminder($reminder);
                }
            }

            return $reminders;

        } 

        public function createReminder(Reminders $reminder){

            $stmt = $this->conn->prepare("INSERT INTO 
                tb_reminders (title, description, reminder_date, users_id, created) 
                VALUES (:title, :description, :reminder_date, :users_id, NOW())"
            );
            $stmt->bindParam(":title", $reminder->title);
            $stmt->bindParam(":description", $reminder->description);
            $stmt->bindParam(":reminder_date", $reminder->reminder_date);
            $stmt->bindParam(":users_id", $reminder->users_id);

            if($stmt->execute()) {
                $this->message->setMessage("Lembrete inserido com sucesso!", "success", "back");
            }
            

        }

        public function updateReminder(Reminders $reminder){
            $stmt = $this->conn->prepare("UPDATE tb_reminders SET
                                        title = :title, 
                                        description = :description,
                                        reminder_date = :reminder_date,
                                        modified = NOW()
                                        WHERE users_id = :users_id
            "); 
            $stmt->bindParam(":title", $reminder->title);
            $stmt->bindParam(":description", $reminder->description);
            $stmt->bindParam(":reminder_date", $reminder->reminder_date);
            $stmt->bindParam(":users_id", $reminder->users_id);

            if ($stmt->execute()) {
                $this->message->setMessage("Lembrete atualziado com sucesso!", "success", "back");
            }            

        }

        public function destroyReminder($id){

            if ($id) {
                
                $stmt = $this->conn->prepare("DELETE FROM tb_reminders WHERE id = :id");
                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    $this->message->setMessage("Lembrete deletado com sucesso!", "success", "back");
                }

            }


        }
       

    }