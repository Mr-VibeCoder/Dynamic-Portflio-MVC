<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // or your password if using online hosting
$db = 'vibe_portfolio';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>
