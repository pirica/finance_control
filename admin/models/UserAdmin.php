<?php
require_once "../models/User.php";
Class UserAdmin extends User{
  
}

interface UserDAOAdminInterface {
    public function buildUser($data); #irá construir o objeto
    public function update(UserAdmin $user, $redirect = true);
    public function verifyToken($protected = false); # irá verificar usuário
    public function setTokenSession($token, $redirect = true); # irá fazer o login
    public function authenticatorUserAdmin($email, $password); #junto com setTokenSession irá efetuar autenticação no admin
    public function findAdminUser($email); #irá encontrar usuário admin
    public function destroyToken(); // destroy a sessão através do token
}