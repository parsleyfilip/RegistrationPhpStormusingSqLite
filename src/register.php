<?php
require_once __DIR__ . '/../config/db.php';

function registerUser($username, $email, $password) {
    $db = new Database();
    $conn = $db->getConnection();

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (registerUser($username, $email, $password)) {
        header('Location: /public/index.php');
    } else {
        echo "Registration failed.";
    }
}
?>