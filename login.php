<?php
session_start();
require 'config.php';

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] =  $user['userId'];
        header("Location: members.php");
        exit;
    } else {
        $errorMessage = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Flower Power</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="  background-image: url('images/garden.jpg');
            background-size: cover;
            background-position: center; 
        ">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card" style="width: 100%; max-width: 400px;">
            <div class="card-body">
                <h2 class="card-title text-center">Login</h2>
                <?php if ($errorMessage): ?>
                    <div class="alert alert-danger text-center"><?php echo htmlspecialchars($errorMessage); ?></div>
                <?php endif; ?>
                <form method="post" class="login-form">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <p class="text-center mt-2">Don't have an account? <a href="register.php">Register here</a></p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>