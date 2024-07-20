<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results</h1>
    <a href="index.php">Back to search</a>
    <?php if (isset($results['Search'])): ?>
        <ul>
            <?php foreach ($results['Search'] as $movie): ?>
                <li>
                    <a href="index.php?id=<?php echo urlencode($movie['imdbID']); ?>">
                        <?php echo htmlspecialchars($movie['Title']) . " (" . htmlspecialchars($movie['Year']) . ")"; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</body>
</html>
