<?php
require 'controllers/UserController.php';
require 'controllers/SearchController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'search';

switch ($action) {
    case 'signup':
        $controller = new UserController();
        $controller->signup();
        break;
    case 'login':
        $controller = new UserController();
        $controller->login();
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
    case 'addReview':
        $controller = new SearchController();
        $controller->addReview();
        break;
    case 'search':
    default:
        $controller = new SearchController();
        $controller->search();
        break;
}
?>
