<?php
require_once '../config/db.php';
require_once '../models/Order.php';
require_once '../models/Cart.php';
session_start();
$user = $_SESSION['user'];
$cartItems = new Cart($pdo);
$orders = new Order($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard</title>
    <link rel="icon" href="../public/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #fdf8df; color: #000;">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-white border-end p-3" style="width: 250px; height: 100vh; background-color: #f8f9fa;">
            <div class="text-center mb-4">
                <br>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAK4AAACUCAMAAAA9M+IXAAAAM1BMVEXk5ueutLenrrHg4+Tn6eqqsbTGysyxt7rJzc/O0dO4vcDa3d67wMK+w8Xe4OK0ur3U19h8wNGYAAAD/ElEQVR4nO2b0XKsIAxARYKKiPL/X1twt7e1XV0gmNC5nIedPp5JIQRMuq7RaDQajUaj0Wg0Go0aAeA2iAS8qTHOObPuf1cMdNINc+9RSoXfeTCyq1QZjLZjr8R3VD9aLSsUhtVu4uj6NFbbUJ2wtOqV66dxVcIgpwvZXVhM1axhMPO17C68rHX4gn7ruvuOrgrf4X1on8ITt6rHxtoK0Q/s8V3ibX18mX1lkq33tZy2kLAS+OMLU59o62HLD2BSYxsYDZOu3DJshZolj250wv3hO7Esh6ylEOg5wgtjrq5Y6MMLLtvW7zZ636x99oD+sIgsw84gT2bJ59khvNRnm0EFVyhiXY0Jrs9lmtQXEBtthziXZdQ2RyhlwaF1KQuz9Dr3F5S5AUasrbKEuhJrKwRlGYnMuoFtJbMFh9clLHOQBcMDutQAE95W0Z1rMDTdO3XRp0SL7rnuH9tqBRKZIkxkf+uYKHIIE94uV7zuTFczdIC2JX1qgAXtS1qeIy/CgvpVGn1XI32FRF/cZ9qL+4RbDYRn2g720YlUtsM+6VHegwN/7cG0Qzw1KEv+dQKVehk+BSJechg+pSCe9XrC6uYbmcmB6yu2yVoObB9ZMz+tOR7bvAs89fF78E1sFmE4zw7IiA6yg+3CKBt8t6TWIWbbDroEX39BY+/Mim92qsG2i+4aqaJJrwstRBELQm0MTQyvATm8bYitq4PXbBcFj+oXrm6sM8As4mWIlRptNevgCwAzLOpXq7xYhgplAwDSaLs95hD2SYTRaiNrH55YndaT1m6tWzQAP+D2OWOXW40JkR12QoCfozR1WYcxHzctJ+9m4+xXcB1DS353rZ/b6yLv+m0nlsnxbjvv6qYwOhNVM/hc4ZOa5tp/AM6O4uWYz4WyXxqavC4LcbWX//8r537WK2EF4TfWtMWtgDNjYR2RsF8ES37r7pfwRjG0BJ1OW65XDDe/PoHUV4ViKkpMd5Y/oJPfFd4J3zcpCGvSJT0afYusLNAi8pJ+Lv86De6e0AZumGwcyuWDV8JzyS0HBp9o3/j25VYwuFtD+xQu9TWoRBtWjO9Wxrd0rj0XLjCamzqeiAKd0Uht8b73ZduX9KiElvqWjwfVDYdv4E8mfxSTKIP99M3MZ6ALlrbxqLw2nbyx2hK+eaOjM4+tyEtnLAv3QcZxXKCJNJv0FgIgPh+OpDZoMGWFf6RmB2zTIJak3VaggxRH2rduyZfEPn1TekoQA+GldFO6pxlKm1++8blX8tsm9Oywb7QH0brsGy2gYo8KqCK4InI1lBiRKUFkC1eJeakSRDYfFhixLkLsaC5+5KQIkTNXaxWJQcSWOUb0dRCZGlZZCVG2jf+VD1jmOR4naw8UAAAAAElFTkSuQmCC" alt="Profile" class="rounded-circle" width="100" height="80">
                <p class="mt-2"><?php echo ($user['firstname'] . ' ' . $user['lastname']) ?></p>
                <button onclick="location.href='../views/login.php'" type="button" class="btn btn-success" style="width: 150px; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: 1.02rem;">
                    Logout
                </button>
            </div>
            <ul class="nav flex-column">
                <li onclick="location.href='../views/buyerDashboard.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Dashboard</li>
                <li onclick="location.href='../public/index.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Product Catalog</li>
                <li onclick="location.href='../public/orders.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">My Orders</li>
                <li onclick="location.href='../public/cart.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Cart</li>
                <li onclick="location.href='../views/settings.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Settings</li>
                <li onclick="location.href='../controllers/authSeller.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Become a Seller</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <img src="../public/logo.png" alt="Logo" class="rounded-circle mb-3" style="width: 70px; height: 70px">
                <h1 class="h4 text-success">Buyer Dashboard</h1>
                <p class="text-muted mb-0" id="currentDate"></p>
                <script>
                    date = new Date();
                    document.getElementById("currentDate").innerHTML = date.getUTCDate() + "-" + date.getUTCMonth() + "-" + date.getFullYear();
                </script>
            </header>

            <section class="mb-4">
                <div class="p-3 rounded" style="background-color: #e6ffe6;">
                    <h2 class="h5">Welcome back, <span class="text-success"><?php echo ($user['firstname']) ?></span>!</h2>
                </div>
            </section>

            <section class="mb-4">
                <h2 class="h5 text-success">Your Stats</h2>
                <div class="row g-3 d-flex justify-content-center">
                    <div class="col-md-3">
                        <div class="p-3 text-center rounded" style="background-color: #e6ffe6;">
                            <?php $count = $orders->getOrderNum($user['customer_id']);?>
                            <h3 class="text-success"><?php echo $count; ?></h3>
                            <p class="text-muted">Orders Placed</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 text-center rounded" style="background-color: #e6ffe6;">
                            <?php $count = $cartItems->getTotalCartItemsCount($user['customer_id']);?>
                            <h3 class="text-success"><?php echo $count; ?></h3>
                            <p class="text-muted">Cart Items</p>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h2 class="h5 text-success">Recent Orders</h2>
                <table class="table table-bordered table-hover mt-3">
                    <thead style="background-color: #d0f0c0;">
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#12345</td>
                            <td>Wireless Headphones</td>
                            <td>Shipped</td>
                            <td>$99.99</td>
                            <td>
                                <button class="btn btn-outline-success btn-md">Track</button>
                                <button class="btn btn-outline-secondary btn-md">Invoice</button>
                            </td>
                        </tr>
                        <tr>
                            <td>#12436</td>
                            <td>Running Shoes</td>
                            <td>Delivered</td>
                            <td>$59.99</td>
                            <td>
                                <button class="btn btn-outline-success btn-md">Track</button>
                                <button class="btn btn-outline-secondary btn-md">Invoice</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
        <!-- <ul class="nav flex-column">
            <li onclick="location.href='../views/buyerDashboard.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Dashboard</li>
            <li onclick="location.href='../public/index.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Product Catalog</li>
            <li onclick="location.href='../public/orders.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">My Orders</li>
            <li onclick="location.href='../public/cart.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Cart</li>
            <li onclick="location.href='../views/settings.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Settings</li>
            <li onclick="location.href='../controllers/authSeller.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Become a Seller</li>
        </ul> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>