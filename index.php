<?php
require 'controllers/SearchController.php';
require 'config/database.php';
$controller = new SearchController();
$controller->search();
?>
