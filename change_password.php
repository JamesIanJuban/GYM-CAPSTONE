<?php
session_start();
include 'db.php';

// Check if the session variable is set
if (!isset($_SESSION['reset_email'])) {
    // Redirect to forgot password if no email was verified
    header("Location: forgot_password.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Hash the new password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Update the user password
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashed_password, $_SESSION['reset_email']]);

        // Clear the session variable
        unset($_SESSION['reset_email']);

        echo "<script>alert('Password has been changed successfully!'); window.location.href = 'login.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">
    <form method="POST" class="max-w-lg mx-auto p-8 space-y-4 bg-gray-800 rounded mt-10 text-yellow-400">
        <h2 class="text-4xl font-bold text-center mb-6">Change Password</h2>
        <input type="password" name="password" placeholder="New Password" required class="w-full p-3 border rounded bg-gray-900">
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required class="w-full p-3 border rounded bg-gray-900">
        <button type="submit" class="w-full bg-yellow-400 text-black py-3 rounded font-semibold">Change Password</button>
    </form>
</body>
</html>
