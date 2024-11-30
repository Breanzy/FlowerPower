<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
        $successMessage = "Registration successful! <a href='login.php'>Login here</a>";
    } catch (PDOException $e) {
        $errorMessage = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Flower Power</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body style="  background-image: url('images/garden.jpg');
            background-size: cover;
            background-position: center; 
        ">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card">
            <div class="card-header text-center">
                <h2>Register</h2>
            </div>
            <div class="card-body">
                <?php if (isset($successMessage)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $successMessage; ?>
                    </div>
                <?php elseif (isset($errorMessage)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
                <?php endif; ?>
                <form method="post" class="mt-4">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                    <p class="mt-3 text-center">Already have an account? <a href="login.php" class="text-primary">Login here</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>