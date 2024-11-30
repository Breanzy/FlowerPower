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
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Flower Power - Home</title>
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
         <section class="text-center">
             <h2 class="display-3">Discover Our Beautiful Flowers</h2>
             <p>At Flower Power, we offer a stunning selection of fresh flowers for every occasion. Whether you're looking for a bouquet for a loved one or decorations for an event, we have you covered.</p>
         </section>

         <section class="my-5">
             <h2>Featured Products</h2>
             <div class="row">
                 <div class="col-md-4">
                     <div class="card">
                         <img src="images/rose.jpg" class="card-img-top" alt="Beautiful Roses">
                         <div class="card-body">
                             <h5 class="card-title">Beautiful Roses</h5>
                             <p class="card-text">Price: $19.99</p>
                             <button class="btn btn-primary">Add to Cart</button>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="card">
                         <img src="images/sunflower.jpg" class="card-img-top" alt="Sunflower Bouquet">
                         <div class="card-body">
                             <h5 class="card-title">Sunflower Bouquet</h5>
                             <p class="card-text">Price: $15.99</p>
                             <button class="btn btn-primary">Add to Cart</button>
                         </div>
                     </div>
                 </div>
                 <div class="col-md-4">
                     <div class="card">
                         <img src="images/tulips.jpg" class="card-img-top" alt="Tulip Arrangement">
                         <div class="card-body">
                             <h5 class="card-title">Tulip Arrangement</h5>
                             <p class="card-text">Price: $22.99</p>
                             <button class="btn btn-primary">Add to Cart</button>
                         </div>
                     </div>
                 </div>
             </div>
         </section>

         <section class="my-5">
             <h2>Why Choose Us?</h2>
             <ul class="list-unstyled">
                 <li><strong>Quality Flowers:</strong> We source our flowers from the best growers to ensure freshness and quality.</li>
                 <li><strong>Fast Delivery:</strong> We offer same-day delivery for local orders, so your flowers arrive fresh and on time.</li>
                 <li><strong>Customer Satisfaction:</strong> Our customers are our top priority. We strive to provide excellent service and support.</li>
             </ul>
         </section>

         <section class="my-5">
             <h2>Exclusive Offers for Members</p>
                 <p>If you're a member, enjoy exclusive discounts and promotions on our products. Sign up today to take advantage of these special offers!</p>
         </section>

         <?php if ($isLoggedIn): ?>
             <section class="my-5">
                 <h2>Member-Only Deals</h2>
                 <p>Check out our amazing deals on flowers, exclusively for our members!</p>
                 <div class="sale-items">
                     <div class="row">
                         <div class="col-md-4">
                             <div class="card">
                                 <img src="images/rose.jpg" class="card-img-top" alt="Member Roses">
                                 <div class="card-body">
                                     <h5 class="card-title">Member Special: Roses</h5>
                                     <p class="card-text">Price: $15.99</p>
                                     <button class="btn btn-primary">Add to Cart</button>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="card">
                                 <img src="images/sunflower.jpg" class="card-img-top" alt="Member Sunflower">
                                 <div class="card-body">
                                     <h5 class="card-title">Member Special: Sunflower</h5>
                                     <p class="card-text">Price: $12.99</p>
                                     <button class="btn btn-primary">Add to Cart</button>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-4">
                             <div class="card">
                                 <img src="images/tulips.jpg" class="card-img-top" alt="Member Tulips">
                                 <div class="card-body">
                                     <h5 class="card-title">Member Special: Tulips</h5>
                                     <p class="card-text">Price: $18.99</p>
                                     <button class="btn btn-primary">Add to Cart</button>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </section>
         <?php else: ?>
             <p class="text-center">Please log in or register to see our exclusive member offers!</p>
         <?php endif; ?>
     </main>

     <footer class="bg-success text-center p-3 text-light">
         <p>&copy; <?php echo date("Y"); ?> Flower Power. All rights reserved.</p>
     </footer>

     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 </body>

 </html>