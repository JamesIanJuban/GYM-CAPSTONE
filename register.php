<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $emergency_contact_person = trim($_POST['emergency_contact_person']);
    $emergency_contact_address = trim($_POST['emergency_contact_address']);
    $emergency_contact_number = trim($_POST['emergency_contact_number']);

    // Validate inputs
    if (empty($full_name)) {
        echo "<script>alert('Full name is required.');</script>";
    } elseif (!$email) {
        echo "<script>alert('Invalid email format.');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } elseif (empty($phone)) {
        echo "<script>alert('Phone number is required.');</script>";
    } elseif (empty($address)) {
        echo "<script>alert('Address is required.');</script>";
    } elseif (empty($emergency_contact_person)) {
        echo "<script>alert('Emergency contact person is required.');</script>";
    } elseif (empty($emergency_contact_address)) {
        echo "<script>alert('Emergency contact address is required.');</script>";
    } elseif (empty($emergency_contact_number)) {
        echo "<script>alert('Emergency contact number is required.');</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Check for existing users to determine role
        $stmt = $pdo->query("SELECT COUNT(*) FROM users");
        $user_count = $stmt->fetchColumn();
        
        // Assign role based on user count
        $role = $user_count == 0 ? 'admin' : 'user';

        // Check for existing username or email
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->fetchColumn() > 0) {
            echo "<script>alert('Username or Email already taken.');</script>";
        } else {
            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (full_name, username, email, password, phone, address, emergency_contact_person, emergency_contact_address, emergency_contact_number, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$full_name, $username, $email, $hashed_password, $phone, $address, $emergency_contact_person, $emergency_contact_address, $emergency_contact_number, $role]);

            echo "<script>alert('Registration successful! Redirecting to login...'); window.location.href = 'login.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gym Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center">
    <form method="POST" class="max-w-lg mx-auto p-8 space-y-4 bg-gray-800 rounded mt-10 text-yellow-400">
        <h2 class="text-4xl font-bold text-center mb-6">Register for the Gym</h2>
        
        <input type="text" name="full_name" placeholder="Full Name" required class="w-full p-3 border rounded bg-gray-900">
        
        <input type="text" name="username" placeholder="Username" required class="w-full p-3 border rounded bg-gray-900">
        
        <input type="email" name="email" placeholder="Email" required class="w-full p-3 border rounded bg-gray-900">
        
        <input type="password" name="password" placeholder="Password" required class="w-full p-3 border rounded bg-gray-900">
        
        <input type="password" name="confirm_password" placeholder="Confirm Password" required class="w-full p-3 border rounded bg-gray-900">
        
        <input type="text" name="phone" placeholder="Phone Number" required class="w-full p-3 border rounded bg-gray-900">
        
        <input type="text" name="address" placeholder="Address" required class="w-full p-3 border rounded bg-gray-900">
        
        <input type="text" name="emergency_contact_person" placeholder="Emergency Contact Person" required class="w-full p-3 border rounded bg-gray-900">
        
        <input type="text" name="emergency_contact_address" placeholder="Emergency Contact Address" required class="w-full p-3 border rounded bg-gray-900">
        
        <input type="text" name="emergency_contact_number" placeholder="Emergency Contact Number" required class="w-full p-3 border rounded bg-gray-900">
        
        <button type="submit" class="w-full bg-yellow-400 text-black py-3 rounded font-semibold">Register</button>
        
        <p class="text-center mt-4">
            Already have an account? <a href="login.php" class="text-yellow-300 hover:underline">Login</a>
        </p>
    </form>
</body>
</html>
