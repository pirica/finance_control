<?php 
require_once("../globals.php");
require_once("models/UserAdmin.php");
require_once("models/Message.php");

Class UserDAO implements UserDAOAdminInterface{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url){
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    // constrói o objeto usuário
    public function buildUser($data){

        $user = new UserAdmin();

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

    public function update(UserAdmin $user, $redirect = true){

        $stmt = $this->conn->prepare("UPDATE users SET
            name = :name,
            lastname = :lastname,
            email = :email,
            image = :image,
            bio = :bio,
            token = :token
            WHERE id = :id        
        ");

        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":lastname", $user->lastname);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":image", $user->image);
        $stmt->bindParam(":bio", $user->bio);
        $stmt->bindParam(":token", $user->token);
        $stmt->bindParam(":id", $user->id);

        $stmt->execute();

        if ($redirect) {
            
            // redireciona para a dashboard
            $this->message->setMessage("Dados atualizados com sucesso!", "success", "edit_profile.php");

        }

    }

    public function verifyToken($protected = false){

        if (!empty($_SESSION['token'])) {
            
            // pega o token
            $token = $_SESSION['token'];

            // verifica se o token existe
            $user = $this->findByToken($token);

            if ($user) {

                // retorna o usuário para o front
                return $user;
            }else {
                // Redireciona o usuário não autenticado
                $this->message->setMessage("É necessário estar autenticado para acessar esta página!", "error", "index.php");
            }

        }else if ($protected){
             // Redireciona o usuário não autenticado
             $this->message->setMessage("É necessário estar autenticado para acessar esta página!", "error", "index.php");
        }

    } 

    public function setTokenSession($token, $redirect = true){

        // salva token na Session
        $_SESSION["token"] = $token;

        // Rediciona o novo usuário para a dashboard
        if ($redirect) {
            $this->message->setMessage("Seja bem vindo!", "success", "dashboard.php");
        }

    } 

    public function authenticatorUserAdmin($email, $password){

        $user = $this->findAdminUser($email);

        // Se encontrar - email no BD
        if ($user) {
            
            if (password_verify($password, $user->password)) {
                
                // gera um novo token e insere na session
                $token = $user->generateToken();

                $this->setTokenSession($token, false);

                //atualiza o token do usuário no objeto e depois no BD
                $user->token = $token;

                $this->update($user, false);

                return true;

            }else {
                return false;
            }

        }else {
            return false;
        }

    } 

    public function findAdminUser($email){

        // Checa se existe valor na variável
        if ($email != "") {
            
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE admin = 'S' AND email = :email");
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

    public function findByToken($token){

        // Checa se existe valor na variável
        if ($token != "") {
           
           $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
           $stmt->bindParam(":token", $token);
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

    public function destroyToken(){

        // Remove o tokeen da Session
        $_SESSION["token"] = "";

        // Redireciona e apresenta a mensaem de sucesso
        $this->message->setMessage("Loggout efetuado com sucesso.", "success", "index.php");

    } 

}