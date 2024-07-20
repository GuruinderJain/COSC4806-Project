<?php
class OMDBModel {
    private $apiKey;

    public function __construct() {
        $this->apiKey = $_ENV['OMDB_API_KEY'];
    }

    public function searchMovies($title) {
        $url = "http://www.omdbapi.com/?apikey={$this->apiKey}&s=" . urlencode($title);
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    public function getMovieDetails($id) {
        $url = "http://www.omdbapi.com/?apikey={$this->apiKey}&i=" . urlencode($id);
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}
?>
