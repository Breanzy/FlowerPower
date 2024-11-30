<?php
session_start();
require 'config.php';


$isLoggedIn = isset($_SESSION['user_id']);
$userName = '';
if ($isLoggedIn) {
    $userId = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT username FROM users WHERE userId = :id");
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch();

    if ($user) {
        $userName = $user['username'];
    }
}



if (!$user) {
    // Handle case where user is not found in the database
    echo "User  not found.";
    exit;
}

$exclusiveProducts = [
    ['name' => 'Elegant Orchid', 'price' => 29.99],
    ['name' => 'Lily Bouquet', 'price' => 24.99],
    ['name' => 'Tulip Arrangement', 'price' => 19.99],
    ['name' => 'Sunflower Delight', 'price' => 15.99],
    ['name' => 'Rose Bouquet', 'price' => 35.99],
    ['name' => 'Daisy Chain', 'price' => 12.99],
    ['name' => 'Carnation Surprise', 'price' => 18.99],
    ['name' => 'Chrysanthemum Charm', 'price' => 22.99],
    ['name' => 'Peony Paradise', 'price' => 30.99],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Area - Flower Power</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <header class="bg-success p-3 d-flex justify-content-between align-items-center">
        <a href="index.php">
            <h1 class="text-center text-white">Flower Power</h1>
        </a>
        <div class="text-center">
            <ul class="list-inline p-2 text-light m-0">
                <?php if ($isLoggedIn): ?>
                    <li class="list-inline-item">Hello, <?php echo htmlspecialchars($userName); ?>!</li>
                    <li class="list-inline-item btn btn-info"><a href="members.php">Profile</a></li>
                    <li class="list-inline-item btn btn-danger"><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="list-inline-item btn btn-success"><a href="register.php">Register</a></li>
                    <li class="list-inline-item btn btn-primary"><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <main class="container mt-4">
        <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p>Member benefits: Exclusive discounts, early access to products, and more!</p>

        <h3>Exclusive Products for Members</h3>
        <div class="row">
            <?php if (!empty($exclusiveProducts)): ?>
                <?php foreach ($exclusiveProducts as $product): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="card-text">Price: $<?php echo number_format($product['price'], 2); ?></p>
                                <button class="btn btn-primary">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No exclusive products available at the moment.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="bg-light text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> Flower Power. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>