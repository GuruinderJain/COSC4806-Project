<?php
require_once 'models/OMDBModel.php';
require_once 'models/ReviewModel.php';

class SearchController {
    private $model;
    private $reviewModel;

    public function __construct() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit();
        }

        $this->model = new OMDBModel();
        $this->reviewModel = new ReviewModel();
    }

    public function search() {
        if (isset($_GET['title'])) {
            $title = $_GET['title'];
            $results = $this->model->searchMovies($title);
            require 'views/results.php';
        } elseif (isset($_GET['id'])) {
            $id = $_GET['id'];
            $movie = $this->model->getMovieDetails($id);
            $reviews = $this->reviewModel->getReviewsByMovieId($id);
            $aiReview = isset($_POST['getAIReview']) ? $this->reviewModel->getAIReview($movie['Title']) : null;
            require 'views/movie.php';
        } else {
            require 'views/search.php';
        }
    }
    public function addReview() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $movieId = $_POST['movieId'];
            $review = $_POST['review'];
            $rating = $_POST['rating'];

            if ($this->reviewModel->addReview($userId, $movieId, $review, $rating)) {
                header('Location: index.php?id=' . $movieId);
            } else {
                echo "Failed to add review.";
            }
        }
    }
    public function getAIReview() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movieTitle = $_POST['movieTitle'];
            $aiReview = $this->reviewModel->getAIReview($movieTitle);
            echo json_encode(['review' => $aiReview]);
            exit;
        }
    }
}
?>
