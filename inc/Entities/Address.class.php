<?php

class Address{
    
    private $AddressID;
    private $UserID;
    private $State;
    private $Street;
    private $City;

    public function setAddressID($Addressid){
        $this->AddressID = $Addressid;
    }

    public function setUserID($UserID){
        $this->UserID = $UserID;
    }

    public function setState($state){
        $this->State = $state;
    }

    public function setStreet($street){
        $this->Street = $street;
    }

    public function setCity($city){
        $this->City = $city;
    }

    public function getAddressID(){
        return $this->AddressID;
    }

    public function getUserID(){
        return $this->UserID;
    }
    public function getState(){
        return $this->State;
    }

    public function getStreet(){
        return $this->Street;
    }

    public function getCity(){
        return $this->City;
    }

}

?>