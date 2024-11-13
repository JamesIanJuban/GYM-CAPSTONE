<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo "<script>alert('Invalid email format');</script>";
    } else {
        // Check if email exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Store the email in session to carry over to the change password form
            $_SESSION['reset_email'] = $email;
            header("Location: change_password.php");
            exit;
        } else {
            echo "<script>alert('Email not found');</script>";
        }
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
        <input type="email" name="email" placeholder="Email" required class="w-full p-3 border rounded bg-gray-900">
        <button type="submit" class="w-full bg-yellow-400 text-black py-3 rounded font-semibold">Verify Email</button>
        <p class="text-center mt-4">
            Remembered your password? <a href="login.php" class="text-yellow-300 hover:underline">Login</a>
        </p>
    </form>
</body>
</html>
