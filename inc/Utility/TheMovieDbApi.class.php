<?php

/**
 * All credits to TheMovieDb API
 * Website: https://developers.themoviedb.org
 */

class TheMovieDbApi {
    private static $apiKey = 'bacfab80d0f2c7969a9b04993042bafb';

    /*
    {
    "page": 1,
    "total_results": 16552,
    "total_pages": 828,
    "results": [
        {
            "vote_count": 10598,
            "id": 284053,
            "video": false,
            "vote_average": 7.5,
            "title": "Thor: Ragnarok",
            "popularity": 65.036,
            "poster_path": "/rzRwTcFvttcN1ZpX2xv4j3tSdJu.jpg",
            "original_language": "en",
            "original_title": "Thor: Ragnarok",
            "genre_ids": [
                28,
                12,
                35,
                14,
                878
            ],
            "backdrop_path": "/kaIfm5ryEOwYg8mLbq8HkPuM1Fo.jpg",
            "adult": false,
            "overview": "Thor is imprisoned on the other side of the universe and finds himself in a race against time to get back to Asgard to stop Ragnarok, the destruction of his home-world and the end of Asgardian civilization, at the hands of an all-powerful new threat, the ruthless Hela.",
            "release_date": "2017-10-25"
    },
    */

        /**
     * Get the movie by the specific id.
     * Documentation: https://developers.themoviedb.org/3/movies/get-movie-details
     */
    public static function getMovieById(int $movieId) {
        $movie = file_get_contents(
            sprintf('https://api.themoviedb.org/3/movie/%d?api_key=%s',
            $movieId, self::$apiKey)
        );
        $jsonDecodedResponse = json_decode($movie);
        return $jsonDecodedResponse;
        
    }

    public static function getMovieByName($movies ,string $moviename) {
        if(empty($moviename)) return $movies;
        foreach ($movies as $movie) {
            if(strcasecmp($movie->title, $moviename) == false) {
                return $movie;
            }
        }
        
    }
    /**
     * This is the way to retrieve images 500x500.
     */
    public static function getMoviesBetweenYears(int $startYear, int $endYear) {
        $movies = file_get_contents(
            sprintf('https://api.themoviedb.org/3/discover/movie?api_key=%s&primary_release_date.gte=%d&primary_release_date.lte=%d',
            self::$apiKey, $startYear, $endYear)
        );
        $jsonDecodedResponse = json_decode($movies);
        return $jsonDecodedResponse->results;
    }

    public static function getW500Image(string $imageToken) : string {
        return 'https://image.tmdb.org/t/p/w500' . $imageToken;
    }

    public static function getOriginalImage(string $imageToken) : string {
        return 'https://image.tmdb.org/t/p/original' . $imageToken;
    }

    public static function searchMovies($movies, $search) {
        if(empty($search)) return $movies;
        $filteredMovies = [];
        foreach ($movies as $movie) {
            if(stripos($movie->title, $search) !== false) {
                $filteredMovies[] = $movie;
            }
        }
        return $filteredMovies;
    }
}

?>