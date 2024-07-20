<?php
require_once 'models/OMDBModel.php';

class SearchController {
    private $model;

    public function __construct() {
        $this->model = new OMDBModel();
    }

    public function search() {
        if (isset($_GET['title'])) {
            $title = $_GET['title'];
            $results = $this->model->searchMovies($title);
            require 'views/results.php';
        } elseif (isset($_GET['id'])) {
            $id = $_GET['id'];
            $movie = $this->model->getMovieDetails($id);
            require 'views/movie.php';
        } else {
            require 'views/search.php';
        }
    }
}
?>
