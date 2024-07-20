<!DOCTYPE html>
<html>
<head>
    <title>Movie</title>
      <link href="styles.css" rel="stylesheet">
</head>
<body>
    <h1><?php echo htmlspecialchars($movie['Title']); ?></h1>
    <img src="<?php echo htmlspecialchars($movie['Poster']); ?>" alt="Movie Poster">
    <p><strong>Year:</strong> <?php echo htmlspecialchars($movie['Year']); ?></p>
    <p><strong>Released:</strong> <?php echo htmlspecialchars($movie['Released']); ?></p>
    <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie['Genre']); ?></p>
    <h2>Reviews</h2>
    <?php if (!empty($reviews)): ?>
        <ul>
            <?php foreach ($reviews as $review): ?>
                <li>
                    <p><strong><?php echo htmlspecialchars($review['email']); ?>:</strong></p>
                    <p>Rating: <?php echo htmlspecialchars($review['rating']); ?>/10</p>
                    <p><?php echo nl2br(htmlspecialchars($review['review'])); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No reviews yet.</p>
    <?php endif; ?>
    <h2>Add a Review</h2>
    <form action="index.php?action=addReview" method="post">
        <input type="hidden" name="movieId" value="<?php echo htmlspecialchars($movie['imdbID']); ?>">
        <textarea name="review" placeholder="Write your review here..." required></textarea>
        <br>
        <label for="rating">Rating:</label>
        <select name="rating" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br>
        <button type="submit">Submit Review</button>
    </form>


    <h2>AI Review</h2>
    <form action="index.php?action=search&id=<?php echo htmlspecialchars($movie['imdbID']); ?>" method="post">
        <input type="hidden" name="getAIReview" value="true">
        <input type="hidden" name="movieTitle" value="<?php echo htmlspecialchars($movie['Title']); ?>">
        <button type="submit">Get AI Review</button>
    </form>
    <?php if (isset($aiReview)): ?>
        <p id="ai-review"><?php echo htmlspecialchars($aiReview); ?></p>
    <?php endif; ?>


    
    <a href="index.php">Back to search</a>
</body>
</html>
