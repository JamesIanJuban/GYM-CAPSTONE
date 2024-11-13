<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['plan_id'] as $index => $plan_id) {
        $plan_name = $_POST['plan_name'][$index];
        $price = $_POST['price'][$index];

        $stmt = $pdo->prepare("UPDATE pricing SET plan_name = ?, price = ? WHERE id = ?");
        $stmt->execute([$plan_name, $price, $plan_id]);
    }

    header("Location: admin_dashboard.php");
    exit;
}
?>
