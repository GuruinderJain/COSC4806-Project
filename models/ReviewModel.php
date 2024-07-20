<?php
require_once 'config/database.php';

class ReviewModel {
    private $conn;
    private $table_name = "reviews";

    public function __construct() {
        global $conn; 
        $this->conn = $conn;
    }

    public function addReview($userId, $movieId, $review, $rating) {
        $query = "INSERT INTO " . $this->table_name . " (userId, movieId, review, rating) VALUES (:userId, :movieId, :review, :rating)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':movieId', $movieId);
        $stmt->bindParam(':review', $review);
        $stmt->bindParam(':rating', $rating);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getReviewsByMovieId($movieId) {
        $query = "SELECT r.*, u.email FROM " . $this->table_name . " r JOIN users u ON r.userId = u.id WHERE movieId = :movieId";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':movieId', $movieId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
