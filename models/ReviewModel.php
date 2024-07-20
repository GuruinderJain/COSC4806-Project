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
    
    public function getAIReview($movieTitle) {
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=" . $_ENV['GEMINI_API_KEY'];
        $data = array(
            "contents" => array(
                array(
                    "role" => "user",
                    "parts" => array(
                        array(
                            "text" => "Please give a review of the movie " . $movieTitle . " with an average rating of 4 out of 5."
                        )
                    )
                )
            )
        );
        $json_data = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);
        if ($curlError) {
            error_log('Curl error: ' . $curlError); 
            echo 'Curl error: ' . $curlError;
            return false;
        }
        error_log('API response: ' . $response); 
        $responseData = json_decode($response, true);
        
        return $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'No review available.';
    }
}
?>
