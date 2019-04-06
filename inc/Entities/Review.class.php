<?php

class Review{
    
    private $ReviewID;
    private $MovieID;
    private $UserID;
    private $ReviewDesc;
    private $Rating;
    private $Date;

    public function setDate($date){
       $this->Date = $date; 
    }

    public function setReviewID($reviewID){
        $this->ReviewID = $reviewID;
    }

    public function setUserID($userid){
        $this->UserID = $userid;
    }

    public function setMovieID($MovieID){
        $this->MovieID = $MovieID;
    }

    public function setRating($rating){
        $this->Rating = $rating;
    }

    public function setReviewDesc($Reviewdesc){
        $this->ReviewDesc = $Reviewdesc;
    }

    public function getDate(){
        return $this->Date; 
     }

    public function getReviewID(){
        return $this->ReviewID;
    }

    public function getRating(){
        return $this->Rating;
    }

    public function getReviewDesc(){
        return $this->ReviewDesc;
    }

    public function getMovieID(){
        return $this->MovieID;
    }

    public function getUserID(){
        return $this->UserID;
    }

}
