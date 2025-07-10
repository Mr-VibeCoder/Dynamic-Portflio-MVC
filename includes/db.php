<?php
$host = 'ssql102.infinityfree.com';
$user = 'if0_39436616';
$pass = 'zzJdhe3LICNh';
$db   = 'if0_39436616_portfolio';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>
