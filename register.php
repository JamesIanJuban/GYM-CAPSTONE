<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $address = trim($_POST['address']);
    $mobile_number = trim($_POST['mobile_number']);
    $birthdate = trim($_POST['birthdate']);
    $emergency_contact_person = trim($_POST['emergency_contact_person']);
    $emergency_contact_number = trim($_POST['emergency_contact_number']);

    if (!$email) {
        echo "<script>alert('Invalid email format');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if username or email is already taken
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->fetchColumn() > 0) {
            echo "<script>alert('Username or Email already taken');</script>";
        } else {
            try {
                // Check if this is the first account to determine the role
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
                $stmt->execute();
                $is_first_account = $stmt->fetchColumn() == 0;

                $role = $is_first_account ? 'admin' : 'user';

                // Insert the new user with the determined role
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, address, mobile_number, birthdate, emergency_contact_person, emergency_contact_number, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([$username, $email, $hashed_password, $address, $mobile_number, $birthdate, $emergency_contact_person, $emergency_contact_number, $role])) {
                    echo "<script>
                        Swal.fire({
                            title: 'Registration Successful!',
                            icon: 'success',
                            confirmButtonText: 'Proceed to Login'
                        }).then(() => window.location.href = 'login.php');
                    </script>";
                }
            } catch (PDOException $e) {
                echo "<script>alert('Registration failed.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body class="bg-black text-yellow-400">

<div class="container mx-auto py-10 max-w-lg relative">
    <!-- Close button -->
    <a href="landing_page.php" class="absolute top-0 right-0 p-2 text-yellow-400 hover:text-yellow-500" title="Return to Landing Page">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </a>

    <h2 class="text-4xl mb-6 text-center font-bold text-yellow-400">Register</h2>
    <form method="POST" action="" class="bg-black p-8 rounded-lg shadow-lg space-y-6 border border-yellow-400">
        <div>
            <label for="username" class="block text-sm font-semibold mb-1 text-yellow-400">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required class="w-full p-3 border border-yellow-400 rounded bg-black text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>
        <div>
            <label for="email" class="block text-sm font-semibold mb-1 text-yellow-400">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required class="w-full p-3 border border-yellow-400 rounded bg-black text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>
        <div>
            <label for="password" class="block text-sm font-semibold mb-1 text-yellow-400">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required class="w-full p-3 border border-yellow-400 rounded bg-black text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>
        <div>
            <label for="confirm_password" class="block text-sm font-semibold mb-1 text-yellow-400">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required class="w-full p-3 border border-yellow-400 rounded bg-black text-yellow-400">
        </div>
        <div>
            <label for="address" class="block text-sm font-semibold mb-1 text-yellow-400">Address</label>
            <input type="text" id="address" name="address" placeholder="Enter your address" required class="w-full p-3 border border-yellow-400 rounded bg-black text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>
        <div>
            <label for="mobile_number" class="block text-sm font-semibold mb-1 text-yellow-400">Mobile Number</label>
            <input type="text" id="mobile_number" name="mobile_number" placeholder="Enter your mobile number" required class="w-full p-3 border border-yellow-400 rounded bg-black text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>
        <div>
            <label for="birthdate" class="block text-sm font-semibold mb-1 text-yellow-400">Date of Birth</label>
            <input type="date" id="birthdate" name="birthdate" required class="w-full p-3 border border-yellow-400 rounded bg-black text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>
        <div>
            <label for="emergency_contact_person" class="block text-sm font-semibold mb-1 text-yellow-400">Emergency Contact Person</label>
            <input type="text" id="emergency_contact_person" name="emergency_contact_person" placeholder="Enter emergency contact person" required class="w-full p-3 border border-yellow-400 rounded bg-black text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>
        <div>
            <label for="emergency_contact_number" class="block text-sm font-semibold mb-1 text-yellow-400">Emergency Contact Number</label>
            <input type="text" id="emergency_contact_number" name="emergency_contact_number" placeholder="Enter emergency contact number" required class="w-full p-3 border border-yellow-400 rounded bg-black text-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>
        <button type="submit" class="w-full bg-yellow-400 text-black py-3 rounded font-semibold hover:bg-yellow-500 transition">Register</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const birthdateInput = document.getElementById("birthdate");
        const today = new Date().toISOString().split("T")[0];
        birthdateInput.setAttribute("max", today);
    });
</script>

</body>
</html>
