<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the user is logged in and has the user role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}

// Fetch user profile information
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Fetch user's membership details
$stmt = $pdo->prepare("SELECT m.name AS membership_name, m.price AS membership_price 
                        FROM memberships m 
                        JOIN users u ON u.membership_id = m.id
                        WHERE u.user_id = ?");
$stmt->execute([$user_id]);
$membership = $stmt->fetch();

// Fetch user's billing history
$stmt = $pdo->prepare("SELECT amount, billing_date FROM billing WHERE member_id = ?");
$stmt->execute([$user_id]);
$billing_history = $stmt->fetchAll();

// Fetch user's boxing sessions
$stmt = $pdo->prepare("SELECT id, session_date, session_time, duration FROM boxing_sessions WHERE user_id = ?");
$stmt->execute([$user_id]);
$boxing_sessions = $stmt->fetchAll();

// Function to display feedback messages
function displayFeedback() {
    if (isset($_SESSION['feedback'])) {
        echo '<div class="bg-yellow-500 text-black p-4 rounded mt-4">' . htmlspecialchars($_SESSION['feedback']) . '</div>';
        unset($_SESSION['feedback']); // Clear the message after displaying it
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-yellow-400 min-h-screen flex flex-col items-center">
    <h1 class="text-5xl font-bold mt-10">User Dashboard</h1>
    <p class="mt-4">Welcome, <?= htmlspecialchars($user['username']) ?>!</p>

    <?php displayFeedback(); ?>

    <!-- Profile Information -->
    <div class="mt-6 bg-gray-800 p-6 rounded shadow-lg w-full max-w-2xl">
        <h2 class="text-3xl font-bold">Profile Information</h2>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <a href="edit_profile.php" class="text-yellow-300 hover:underline">Edit Profile</a>
    </div>

    <!-- Membership Details -->
    <div class="mt-6 bg-gray-800 p-6 rounded shadow-lg w-full max-w-2xl">
        <h2 class="text-3xl font-bold">Membership Details</h2>
        <?php if ($membership): ?>
            <p><strong>Membership:</strong> <?= htmlspecialchars($membership['membership_name']) ?></p>
            <p><strong>Price:</strong> $<?= htmlspecialchars($membership['membership_price']) ?></p>
            <a href="renew_membership.php" class="text-yellow-300 hover:underline">Renew Membership</a>
        <?php else: ?>
            <p>You do not have an active membership. <a href="apply_membership.php" class="text-yellow-300 hover:underline">Apply for a membership</a>.</p>
        <?php endif; ?>
    </div>

    <!-- Billing History -->
    <div class="mt-6 bg-gray-800 p-6 rounded shadow-lg w-full max-w-2xl">
        <h2 class="text-3xl font-bold">Billing History</h2>
        <ul class="space-y-2">
            <?php if ($billing_history): ?>
                <?php foreach ($billing_history as $record): ?>
                    <li>
                        <strong>Amount:</strong> $<?= htmlspecialchars($record['amount']) ?> 
                        <strong>Date:</strong> <?= htmlspecialchars($record['billing_date']) ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No billing records found.</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Boxing Sessions -->
    <div class="mt-6 bg-gray-800 p-6 rounded shadow-lg w-full max-w-2xl">
        <h2 class="text-3xl font-bold">Your Boxing Sessions</h2>
        <ul class="space-y-2">
            <?php if ($boxing_sessions): ?>
                <?php foreach ($boxing_sessions as $session): ?>
                    <li>
                        <strong>Date:</strong> <?= htmlspecialchars($session['session_date']) ?> 
                        <strong>Time:</strong> <?= htmlspecialchars($session['session_time']) ?> 
                        <strong>Duration:</strong> <?= htmlspecialchars($session['duration']) ?> minutes
                        <form action="cancel_session.php" method="POST" class="inline">
                            <input type="hidden" name="session_id" value="<?= htmlspecialchars($session['id']) ?>">
                            <button type="submit" class="text-red-500 hover:underline">Cancel</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>You have no upcoming boxing sessions. <a href="book_session.php" class="text-yellow-300 hover:underline">Book a session</a>.</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Book a New Session -->
    <div class="mt-6 bg-gray-800 p-6 rounded shadow-lg w-full max-w-2xl">
        <h2 class="text-3xl font-bold">Book a New Boxing Session</h2>
        <form action="book_session.php" method="POST">
            <div class="mb-4">
                <label for="session_date" class="block text-sm font-bold">Session Date (YYYY-MM-DD):</label>
                <input type="date" name="session_date" id="session_date" class="border rounded w-full p-2" required>
            </div>
            <div class="mb-4">
                <label for="session_time" class="block text-sm font-bold">Session Time (HH:MM):</label>
                <input type="time" name="session_time" id="session_time" class="border rounded w-full p-2" required>
            </div>
            <div class="mb-4">
                <label for="duration" class="block text-sm font-bold">Duration (minutes):</label>
                <input type="number" name="duration" id="duration" class="border rounded w-full p-2" required>
            </div>
            <button type="submit" class="bg-yellow-500 text-black font-bold py-2 px-4 rounded hover:bg-yellow-400">Book Session</button>
        </form>
    </div>

    <div class="mt-6">
        <a href="logout.php" class="bg-yellow-400 text-black py-2 px-4 rounded">Logout</a>
    </div>
</body>
</html>
