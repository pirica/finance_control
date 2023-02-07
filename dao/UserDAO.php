<?php 
require_once("globals.php");
require_once("models/User.php");
require_once("models/Message.php");

Class UserDAO implements UserDAOInterface{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url){
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    // contrói o objeto usuário
    public function buildUser($data){

        $user = new User();

        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->image = $data['image'];
        $user->token = $data['token'];
        $user->bio = $data['bio'];

        return $user;

    } 

    public function create(User $user, $authUser = false){

    }
    public function update(User $user){

    }
    public function verifyToken($protected = false){

    } 
    public function setTokenSession($token, $redirect = true){

    } 
    public function authenticatorUser($email, $password){

    } 
    public function findByEmail($email){

        // Checa se existe valor na variável
        if ($email != "") {
            
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            // verifica se a query retornou algo
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $user = $this->buildUser($data);

                return $user;
            }else {
                return false;
            }

        }else {
            return false;
        }

    }
    
    public function findById($id){

    } 
    public function findByToken($token){

    } 
    public function destroyToken(){

    } 
    public function changePassword(User $user){

    }

}