<?php
define('DB_HOST', 'upu.h.filess.io');
define('DB_PORT', '3305');
define('DB_NAME', 'COSC4808Project_churchall');
define('DB_USER', 'COSC4808Project_churchall');
define('DB_PASS', $_ENV['DATABASE_PASS']);

try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
} catch(PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
?>
