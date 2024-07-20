<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($movie['Title']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($movie['Title']); ?></h1>
    <img src="<?php echo htmlspecialchars($movie['Poster']); ?>" alt="Movie Poster">
    <p><strong>Year:</strong> <?php echo htmlspecialchars($movie['Year']); ?></p>>
    <p><strong>Released:</strong> <?php echo htmlspecialchars($movie['Released']); ?></p>
    <p><strong>Genre:</strong> <?php echo htmlspecialchars($movie['Genre']); ?></p>
    <a href="index.php">Back to search</a>
</body>
</html>
