<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare SQL query to fetch user based on the username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify user and password
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on user role
        header("Location: " . ($user['role'] == 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php'));
        exit;
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-yellow-400 min-h-screen flex items-center justify-center">
    <div class="bg-gray-800 shadow-lg rounded-lg p-8 max-w-md mx-auto text-yellow-400">
        <h2 class="text-4xl font-bold mb-6 text-center">Login</h2>

        <!-- Display error message if credentials are incorrect -->
        <?php if (isset($error_message)): ?>
            <div class="bg-red-500 text-white p-4 mb-4 rounded"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        
        <!-- Login Form -->
        <form method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Username" required class="w-full p-3 border rounded bg-gray-900">
            <input type="password" name="password" placeholder="Password" required class="w-full p-3 border rounded bg-gray-900">
            <button type="submit" class="w-full bg-yellow-400 text-black py-3 rounded font-semibold">Login</button>
        </form>
        
        <!-- Forgot Password and Register Links -->
        <div class="text-center mt-4">
            <a href="forgot_password.php" class="text-yellow-300 hover:underline">Forgot Password?</a>
            <p class="mt-2">Don't have an account? <a href="register.php" class="text-yellow-300 hover:underline">Register</a></p>
        </div>
    </div>
</body>
</html>
