<?php 


Class UserDAO implements UserDAOInterface{

    public function buildUser($data){

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