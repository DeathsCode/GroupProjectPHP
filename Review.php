<?php
//Require the config
require_once("inc/config.inc.php");

//Require entities
require_once("inc/Entities/User.class.php");

require_once("inc/Entities/Review.class.php");
require_once("inc/Entities/Stats.class.php");
require_once("inc/Entities/Movie.class.php");

//Require Utilities
require_once("inc/Utility/TheMovieDbApi.class.php");
require_once("inc/Utility/Page.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserMapper.class.php");
require_once("inc/Utility/ReviewMapper.class.php");
require_once("inc/Utility/StaticsMapper.class.php");
require_once("inc/Utility/MovieMapper.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Validation.class.php");

session_start();

if(!LoginManager::verifyLogin()) return;


$movies = TheMovieDbApi::getMoviesBetweenYears(2017, 2018);
if(!empty($_GET['movie'])) {
    $movies = TheMovieDbApi::searchMovies($movies, $_GET['movie']);
}

$_SESSION["MOVIE"] = $movies[0];
MovieMapper::inizialize("Movie");
ReviewMapper::inizialize("Review");
StaticsMapper::inizialize("Stats");
$movie = MovieMapper::getMovie($_SESSION["MOVIE"]->title);
if(isset($_POST["update"])){
        $newreview = new Review();
        $newreview->setUserID($_SESSION["user"]->getUserID());
        $newreview->setMovieID($movie->getMovieID());
        $newreview->setReviewDesc($_POST["reviewdesc"]);
        $newreview->setRating($_POST["rating"]);
        $newreview->setDate(date('Y/m/d'));
        if(null == ReviewMapper::getReview($movie->getMovieID(), $_SESSION["user"]->getUserID())){
        ReviewMapper::createReview($newreview);
        }else{
        ReviewMapper::updateReview($newreview);
        }
}
if(isset($_POST["delete"])){
    ReviewMapper::deleteReview($_SESSION["user"]->getUserID(), $movie->getMovieID());

}
$_SESSION["MOVIE"] = $movies[0];
Page::$title = $_SESSION["MOVIE"]->title;
Page::header();
$Rating = StaticsMapper::getRatingTotal($movie->getMovieID())->getRatingSum();
Page::ShowMovie($_SESSION["MOVIE"],floatval($Rating));
if(null != ReviewMapper::getReview($movie->getMovieID(), $_SESSION["user"]->getUserID())){
$Review = ReviewMapper::getReview($movie->getMovieID(), $_SESSION["user"]->getUserID());
}else{
$Review = new Review();
$Review->setRating(0);
$Review->setReviewDesc("");
}
Page::ShowUserReview($Review,$_SESSION["MOVIE"]);
$Reviews = ReviewMapper::getReviews($movie->getMovieID());
Page::showReviews($Reviews);

Page::footer();
?>