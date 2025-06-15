<?php
require_once '../config/db.php';
require_once '../models/Product.php';
require_once '../models/Review.php';
session_start();

$productModel = new Product($pdo);
$reviewModel = new Review($pdo); 
$products = $productModel->getAll();
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="icon" href="logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fdf8df; color: #000;">
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-white border-end p-3" style="width: 250px; height: 100vh;">
        <div class="text-center mb-4">
            <br>
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAK4AAACUCAMAAAA9M+IXAAAAM1BMVEXk5ueutLenrrHg4+Tn6eqqsbTGysyxt7rJzc/O0dO4vcDa3d67wMK+w8Xe4OK0ur3U19h8wNGYAAAD/ElEQVR4nO2b0XKsIAxARYKKiPL/X1twt7e1XV0gmNC5nIedPp5JIQRMuq7RaDQajUaj0Wg0Go0aAeA2iAS8qTHOObPuf1cMdNINc+9RSoXfeTCyq1QZjLZjr8R3VD9aLSsUhtVu4uj6NFbbUJ2wtOqV66dxVcIgpwvZXVhM1axhMPO17C68rHX4gn7ruvuOrgrf4X1on8ITt6rHxtoK0Q/s8V3ibX18mX1lkq33tZy2kLAS+OMLU59o62HLD2BSYxsYDZOu3DJshZolj250wv3hO7Esh6ylEOg5wgtjrq5Y6MMLLtvW7zZ636x99oD+sIgsw84gT2bJ59khvNRnm0EFVyhiXY0Jrs9lmtQXEBtthziXZdQ2RyhlwaF1KQuz9Dr3F5S5AUasrbKEuhJrKwRlGYnMuoFtJbMFh9clLHOQBcMDutQAE95W0Z1rMDTdO3XRp0SL7rnuH9tqBRKZIkxkf+uYKHIIE94uV7zuTFczdIC2JX1qgAXtS1qeIy/CgvpVGn1XI32FRF/cZ9qL+4RbDYRn2g720YlUtsM+6VHegwN/7cG0Qzw1KEv+dQKVehk+BSJechg+pSCe9XrC6uYbmcmB6yu2yVoObB9ZMz+tOR7bvAs89fF78E1sFmE4zw7IiA6yg+3CKBt8t6TWIWbbDroEX39BY+/Mim92qsG2i+4aqaJJrwstRBELQm0MTQyvATm8bYitq4PXbBcFj+oXrm6sM8As4mWIlRptNevgCwAzLOpXq7xYhgplAwDSaLs95hD2SYTRaiNrH55YndaT1m6tWzQAP+D2OWOXW40JkR12QoCfozR1WYcxHzctJ+9m4+xXcB1DS353rZ/b6yLv+m0nlsnxbjvv6qYwOhNVM/hc4ZOa5tp/AM6O4uWYz4WyXxqavC4LcbWX//8r537WK2EF4TfWtMWtgDNjYR2RsF8ES37r7pfwRjG0BJ1OW65XDDe/PoHUV4ViKkpMd5Y/oJPfFd4J3zcpCGvSJT0afYusLNAi8pJ+Lv86De6e0AZumGwcyuWDV8JzyS0HBp9o3/j25VYwuFtD+xQu9TWoRBtWjO9Wxrd0rj0XLjCamzqeiAKd0Uht8b73ZduX9KiElvqWjwfVDYdv4E8mfxSTKIP99M3MZ6ALlrbxqLw2nbyx2hK+eaOjM4+tyEtnLAv3QcZxXKCJNJv0FgIgPh+OpDZoMGWFf6RmB2zTIJak3VaggxRH2rduyZfEPn1TekoQA+GldFO6pxlKm1++8blX8tsm9Oywb7QH0brsGy2gYo8KqCK4InI1lBiRKUFkC1eJeakSRDYfFhixLkLsaC5+5KQIkTNXaxWJQcSWOUb0dRCZGlZZCVG2jf+VD1jmOR4naw8UAAAAAElFTkSuQmCC" alt="Profile" class="rounded-circle" width="100" height="80">
            <p class="mt-2"><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></p>
            <button onclick="location.href='../views/login.php'" type="button" class="btn btn-success">Logout</button>
        </div>
        <ul class="nav flex-column">
            <li onclick="location.href='../controllers/sessionHandle.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Dashboard</li>
            <li onclick="location.href='../public/index.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Product Catalog</li>
            <li onclick="location.href='./orders.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">My Orders</li>
            <li onclick="location.href='./cart.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Cart</li>
            <li onclick="location.href='../views/settings.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Settings</li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <img src="logo.png" alt="Logo" style="width: 70px; height: 70px">
            <h1 class="h4 text-success">Product Catalog</h1>
            <p class="text-muted mb-0" id="currentDate"></p>
            <script>
                const date = new Date();
                document.getElementById("currentDate").innerText =
                    `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}`;
            </script>
        </header>

        <section class="mb-4">
            <div class="p-3 rounded" style="background-color: #e6ffe6;">
                <h2 class="h5">Welcome, <span class="text-success"><?= htmlspecialchars($user['firstname']) ?></span>!</h2>
                <div class="input-group mt-3">
                    <input oninput="searchProducts(this.value)" type="text" class="form-control" placeholder="Search products">
                    <button class="btn btn-success">Search</button>
                </div>
            </div>
        </section>

        <div class="row" id="productList">
            <?php foreach ($products as $product): 
                // Get average rating and review count for this product:
                $avgRating = $reviewModel->getAverageRating($product['product_id']);
                $reviewCount = $reviewModel->getReviewCount($product['product_id']);
            ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                            <p class="card-text">$<?= number_format($product['price'], 2) ?></p>
                             <p class="card-text">Stock: <?= number_format($product['stock'], 2) ?></p>
                            
                            <!--  Reviews Summary -->
                            <div class="mb-2">
                                <?php if ($reviewCount > 0): ?>
                                    <span class="text-warning">
                                        <?= str_repeat('★', round($avgRating)) ?><?= str_repeat('☆', 5 - round($avgRating)) ?>
                                    </span>
                                    <small class="text-muted">(<?= $reviewCount ?> review<?= $reviewCount > 1 ? 's' : '' ?>)</small>
                                <?php else: ?>
                                    <small class="text-muted">No reviews yet</small>
                                <?php endif; ?>
                            </div>
                            
                            <form action="../controllers/Cart/addToCart.php" method="POST" class="mt-2">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                                <div class="input-group mb-2">
                                    <button type="submit" class="btn btn-success">Add to Cart</button>
                                    <input type="number" name="quantity" value="1" min="1" max="<?= htmlspecialchars($product['stock']) ?>" class="form-control" style="max-width: 80px;">
                                </div>
                            </form>
                            <a href="../views/productDetails.php?id=<?= $product['product_id'] ?>" class="btn btn-outline-secondary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div> 
    </div>
</div>

<script>
function searchProducts(query) {
    fetch('handleSearch.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ search: query })
    })
    .then(res => res.json())
    .then(data => {
        const container = document.getElementById("productList");
        container.innerHTML = ""; // Clear current list

        if (data.length === 0) {
            container.innerHTML = '<p class="text-muted">No products found.</p>';
            return;
        }

        data.forEach(product => {
            container.innerHTML += `
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                            <p class="card-text">$${parseFloat(product.price).toFixed(2)}</p>
                            <a href="#" class="btn btn-success">Add to Cart</a>
                        </div>
                    </div>
                </div>
            `;
        });
    });
}

function loadReviews(productId) {
    fetch('../public/handleReviews.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'product_id=' + productId
    })
    .then(res => res.json())
    .then(data => {
        const container = document.getElementById("reviewList");
        container.innerHTML = data.length ? "" : "<p class='text-muted'>No reviews yet.</p>";
        data.forEach(review => {
            container.innerHTML += `
                <div class="border p-2 mb-2 rounded">
                    <strong>${review.firstname} ${review.lastname}</strong> - Rated: ${review.rating}/5 <br>
                    <small class="text-muted">${review.review_date}</small>
                    <p>${review.comments}</p>
                </div>`;
        });
    });
}


</script>
</body>
</html>
