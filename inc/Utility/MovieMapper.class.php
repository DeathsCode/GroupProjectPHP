<?php

class MovieMapper{

    static private $db;


    static function inizialize($ClassName){ 
      
        self::$db  = new PDOAgent($ClassName);

    }
    static function createMovie($movie){
        $SQLCreate = "INSERT INTO Movie(MovieName) VALUES (:moviename)";

        self::$db->query($SQLCreate);

        self::$db->bind(':moviename',$movie);
      
        self::$db->execute();

    }

    static function getMovies(){
        $SQLSelect = "SELECT * FROM Movie";

        self::$db->query($SQLSelect);

        self::$db->execute();

        return self::$db->ResultSet();

    }

    static function SearchMovieByName($moviename){
        $SQLSelect = "SELECT * FROM Movie WHERE MovieName like :moviename";

        self::$db->query($SQLSelect);

        self::$db->bind(':moviename','%'.$moviename.'%');

        self::$db->execute();

        return self::$db->ResultSet();
    }

    static function getMovie($Moviename){
        $SQLSelect = "SELECT * FROM Movie WHERE MovieName = :Moviename";

        self::$db->query($SQLSelect);

        self::$db->bind(':Moviename', $Moviename);
      
        self::$db->execute();

        return self::$db->singleResult();
    }

}

?>