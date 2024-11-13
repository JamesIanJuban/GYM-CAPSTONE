<?php
include 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: user_equipment.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM equipment WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin_equipment.php");
exit;
?>
