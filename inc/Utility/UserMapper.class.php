<?php

class UserMapper    {
    
    //A place to store our DB connection
    private static $db;

    //This function to initiialize the PDO Agent with the user class
    static function initialize() {
        self::$db = new PDOAgent('User');
    }

    //This function gets the user by username
    static function getUserbyName(string $username) {
        $query = "SELECT * FROM user WHERE Username = :username;";
        self::$db->query($query);
        self::$db->bind(':username', $username);
        $user = self::$db->singleResult();
        if($user) return $user;
        else return null;
    }

    static function registerUser(User $newUser) : bool {
        //SQL Query
        try {
            $query = "INSERT INTO User (Username, Password) values (:username, :password);";
            self::$db->query($query);
            self::$db->bind(':username', $newUser->getUsername());
            self::$db->bind(':password', $newUser->getPassword());
            $user = self::$db->execute();
            $rowsAffected = self::$db->rowsAffected();
            if($rowsAffected > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    static function getUserbyID($Username){
        $SQLSelect = "SELECT * FROM User WHERE Username = :username";

        self::$db->query($SQLSelect);

        self::$db->bind(':username',$User->getUsername());
      
        self::$db->execute();

        return self::$db->singleResult();
    }

    static function deleteUser($User){
       
        $SQLDelete = "DELETE FROM User WHERE UserID = :userid";

        self::$db->query($SQLDelete);

        self::$db->bind(':userid',$User->getUserID());
      
        self::$db->execute();

        return self::$db->RowCount();
    }

}

?>