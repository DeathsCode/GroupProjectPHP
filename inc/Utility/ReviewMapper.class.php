<?php

class ReviewMapper{

    private static $db;


    static function inizialize($ClassName){ 
      
        self::$db  = new PDOAgent($ClassName);

    }

    static function createReview($Review){
        $SQLInsert = "INSERT INTO Review(UserID, MovieID, ReviewDesc, Rating, Date) VALUES (:userid, :movieid, :reviewdesc, :rating, :date)";

        self::$db->query($SQLInsert);

        self::$db->bind(':userid',$Review->getUserID());
        self::$db->bind(':movieid',$Review->getMovieID());
        self::$db->bind(':reviewdesc',$Review->getReviewDesc());
        self::$db->bind(':date',$Review->getDate());
        self::$db->bind(':rating',$Review->getRating());
        
      
        self::$db->execute();

        return self::$db->lastInsertID();

    }

    static function updateReview($Review){
        $SQLInsert = "UPDATE Review SET Date = :date, ReviewDesc = :reviewdesc, Rating = :rating
         WHERE UserID = :userid AND MovieID = :movieid";

        self::$db->query($SQLInsert);

        self::$db->bind(':userid',$Review->getUserID());
        self::$db->bind(':movieid',$Review->getMovieID());
        self::$db->bind(':date',$Review->getDate());
        self::$db->bind(':reviewdesc',$Review->getReviewDesc());
        self::$db->bind(':rating',$Review->getRating());
      
        self::$db->execute();


    }

    static function getReview($MovieID, $UserID){
        $SQLSelect = "SELECT * FROM Review WHERE UserID = :userid AND MovieID = :movieid";

        self::$db->query($SQLSelect);

        self::$db->bind(':movieid',$MovieID);
        self::$db->bind(':userid',$UserID);

        self::$db->execute();

        return self::$db->singleResult();
    }

    static function getReviews($MovieID){
        $SQLSelect = "SELECT * FROM Review WHERE MovieID = :movieid";

        self::$db->query($SQLSelect);

        self::$db->bind(':movieid',$MovieID);
      
        self::$db->execute();

        return self::$db->resultSet();
    }

    static function deleteReview($UserID, $MovieID){
        $SQLSelect = "DELETE FROM Review WHERE UserID = :userid AND MovieID = :movieid";

        self::$db->query($SQLSelect);

        self::$db->bind(':movieid',$MovieID);
        self::$db->bind(':userid',$UserID);
      
        self::$db->execute();

    }

}

?>