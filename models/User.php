<?php

Class User {
    private $id;
    private $email;
    private $name;
    private $lastname;
    private $image;
    private $password;
    private $token;
    private $bio;

}

interface UserDAOInterface {
    public function buildUser($data); #irá construir o objeto
    public function create(User $user, $authUser = false); #irá criar o usuario e já fazer login
    public function update(User $user); #irá atualizar usuário no sistema
    public function verifyToken($protected = false); # irá verificar usuário
    public function setTokenSession($token, $redirect = true); # irá fazer o login
    public function authenticatorUser($email, $password); #junto com setTokenSession irá efetuar autenticação
    public function findByEmail($email); #irá encontrar usuário por email
    public function findById($id); #irá encontrar usuário pelo ID
    public function findByToken($token); #irá encontrar usuário no sistema pelo token
    public function destroyToken(); // destroy a sessão através do token
    public function changePassword(User $user); #irá mudar o password
}