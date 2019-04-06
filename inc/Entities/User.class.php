<?php

class User{
    
    private $UserID;
    private $Username;
    private $Password;

    public function setPassword($password){
        $this->Password  = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setUserID($userid){
        $this->UserID = $userid;
    }

    public function setUsername($username){
        $this->Username = $username;
    }

    public function getPassword(){
        return $this->Password;
    }

    public function getUserID(){
        return $this->UserID;
    }

    public function getUsername(){
        return $this->Username;
    }

    public function verifyPassword($password){
        return password_verify($password,$this->Password);
    }
}

?>