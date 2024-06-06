<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . '/../src/home.php';
        break;
    case '' :
        require __DIR__ . '/../src/home.php';
        break;
    case '/login' :
        require __DIR__ . '/../templates/login.html';
        break;
    case '/register' :
        require __DIR__ . '/../templates/register.html';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
?>