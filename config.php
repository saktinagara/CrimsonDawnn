<?php
$host = 'localhost'; // Server database
$user = 'root';      // Username database
$pass = '';          // Password database
$db   = 'crimson_dawn'; // Nama database

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
