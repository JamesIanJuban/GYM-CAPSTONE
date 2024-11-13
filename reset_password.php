<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reset_token = $_POST['reset_token'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?");
    if ($stmt->execute([$new_password, $reset_token])) {
        echo "<p class='text-green-400'>Password has been reset successfully!</p>";
    } else {
        echo "<p class='text-red-400'>Invalid or expired token</p>";
    }
} elseif (isset($_GET['token'])) {
    $reset_token = $_GET['token'];
} else {
    die("Invalid request");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Reset Password</title>
</head>
<body class="bg-black text-yellow-400">
<div class="container mx-auto py-10">
    <h2 class="text-3xl mb-4">Reset Password</h2>
    <form method="POST" action="" class="space-y-4">
        <input type="hidden" name="reset_token" value="<?php echo htmlspecialchars($reset_token); ?>">
        <input type="password" name="new_password" placeholder="New Password" required class="w-full p-2 border border-yellow-400 bg-black text-yellow-400">
        <button type="submit" class="w-full bg-yellow-400 text-black py-2">Reset Password</button>
    </form>
</div>
</body>
</html>
