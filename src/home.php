<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /public/index.php');
    exit;
}

require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("SELECT username FROM users WHERE id = :id");
$stmt->bindParam(':id', $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $username = htmlspecialchars($user['username']); // Protect against XSS
    require __DIR__ . '/../templates/home.php';
} else {
    echo "User not found.";
}
?>