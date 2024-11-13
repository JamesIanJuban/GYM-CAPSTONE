<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch the user from the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Check if the user exists and the password is correct
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-yellow-400 min-h-screen flex items-center justify-center">
<div class="relative bg-gray-800 shadow-lg rounded-lg p-8 w-full max-w-md">
    <!-- Close Button -->
    <a href="landing_page.php" class="absolute top-2 right-2 text-yellow-400 hover:text-yellow-500 text-2xl">
        &times;
    </a>

    <!-- Login Form Header -->
    <h2 class="text-4xl font-bold mb-6 text-center text-yellow-400">Login</h2>

    <!-- Display error message if credentials are invalid -->
    <?php if (isset($error_message)): ?>
        <p class="text-red-400 text-center mb-4"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="POST" action="" class="space-y-6">
        <div>
            <input type="text" name="username" placeholder="Username" required
                   class="w-full p-3 border border-gray-700 rounded-md bg-gray-900 text-yellow-400 placeholder-gray-500 focus:ring-2 focus:ring-yellow-400">
        </div>
        <div>
            <input type="password" name="password" placeholder="Password" required
                   class="w-full p-3 border border-gray-700 rounded-md bg-gray-900 text-yellow-400 placeholder-gray-500 focus:ring-2 focus:ring-yellow-400">
        </div>
        <button type="submit"
                class="w-full bg-yellow-400 text-black py-3 rounded-md font-semibold hover:bg-yellow-500 transition duration-200">
            Login
        </button>
    </form>

    <!-- Additional Links -->
    <a href="forgot_password.php" class="text-yellow-400 underline block mt-6 text-center hover:text-yellow-500 transition duration-200">
        Forgot Password?
    </a>
    <a href="register.php" class="text-yellow-400 underline block mt-4 text-center hover:text-yellow-500 transition duration-200">
        Don't have an account? Register
    </a>
</div>
</body>
</html>
