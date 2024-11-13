<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $reset_token = bin2hex(random_bytes(50));
        $stmt = $pdo->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $stmt->execute([$reset_token, $email]);

        // Normally you would send the reset link via email here
        echo "<p class='text-green-400'>Password reset link has been sent to your email!</p>";
    } else {
        echo "<p class='text-red-400'>No user found with that email address</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Forgot Password</title>
</head>
<body class="bg-black text-yellow-400">
<div class="container mx-auto py-10">
    <h2 class="text-3xl mb-4">Forgot Password</h2>
    <form method="POST" action="" class="space-y-4">
        <input type="email" name="email" placeholder="Enter your email" required class="w-full p-2 border border-yellow-400 bg-black text-yellow-400">
        <button type="submit" class="w-full bg-yellow-400 text-black py-2">Send Reset Link</button>
    </form>
</div>
</body>
</html>
