
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
<p>Your email: <?php echo htmlspecialchars($user['email']); ?></p>
<p>Member benefits: Exclusive discounts, early access to products, and more!</p>
<a href="logout.php">Logout</a>
