<?php
$host = 'localhost';
$db = 'gym_management'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password

try {
    $pdo = new PDO('mysql:host=localhost;dbname=gym_management', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
