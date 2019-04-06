<?php

class StaticsMapper{
private static $db;


static function inizialize($ClassName){ 
  
    self::$db  = new PDOAgent($ClassName);

}

static function getRatingTotal($MovieID){
    $sqlRating = "SELECT (SUM(Rating)/COUNT(UserID)) as Ratings FROM Review WHERE MovieID = :movieid";

    self::$db->query($sqlRating);

    self::$db->bind('movieid',$MovieID);

    self::$db->execute();

    return self::$db->singleResult();
}

}

?>