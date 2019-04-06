<?php

class AddressMapper{

    static private $db;


    static function inizialize($ClassID){ 
      
        self::$db  = new PDOAgent($ClassID);

    }

    static function createAddress($Address){
        $SQLInsert = "INSERT INTO Address(UserID) VALUES (:userid)";

        self::$db->query($SQLInsert);

        self::$db->bind(':userid',$Address->getUserID());
      
        self::$db->execute();

        return self::$db->lastInsertID();

    }

    static function updateAddress($Address){
        $SQLInsert = "UPDATE Address SET Street = :street, City= :city, State = :state WHERE
        UserID = :userid";

        self::$db->query($SQLInsert);

        self::$db->bind(':street',$Address->getStreet());
        self::$db->bind(':city',$Address->getCity());
        self::$db->bind(':state',$Address->getState());
        self::$db->bind(':userid',$Address->getUserID());
      
        self::$db->execute();

        return self::$db->lastInsertID();

    }

    static function getAddress($User){
        $SQLSelect = "SELECT * FROM Address WHERE UserID = :userid";

        self::$db->query($SQLSelect);

        self::$db->bind(':userid',$User->getUserID());
      
        self::$db->execute();

        return self::$db->singleResult();
    }

}

?>