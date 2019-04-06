<?php
require_once("inc/config.inc.php");

require_once("inc/Entities/User.class.php");
require_once("inc/Entities/Movie.class.php");

require_once("inc/Utility/TheMovieDbApi.class.php");
require_once("inc/Utility/Page.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserMapper.class.php");
require_once("inc/Utility/MovieMapper.class.php");
require_once("inc/Utility/LoginManager.class.php");

session_start();

if(!LoginManager::verifyLogin()) return;

$fullmovies = TheMovieDbApi::getMoviesBetweenYears(2017, 2018);
$movies = array();
if(!empty($_GET)) {
    MovieMapper::inizialize("Movie");
    $Movies = MovieMapper::SearchMovieByName($_GET['search']);
    foreach($Movies as $Movie){
        $movies[] = TheMovieDbApi::getMovieByName($fullmovies,$Movie->getMoviename());
    }
}else{
    $movies = $fullmovies;
}



Page::$title = "GroupProject";
Page::header();
Page::showSearch();
Page::showMovies($movies);
Page::footer();