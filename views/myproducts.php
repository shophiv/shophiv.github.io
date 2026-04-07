<?php
require_once '../config/db.php';
require_once '../models/Product.php';
session_start();

$user = $_SESSION['user'];
$productModel = new Product($pdo);
$products = $productModel->getBySellerId($user['seller_id']);
$categories = ['Electronics', 'Books', 'Clothing', 'Home', 'Beauty'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>My Products</title>
    <link rel="icon" href="../public/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color:#fdf8df;color:#000">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-white border-end p-3" style="width: 250px; height: 100vh; background-color: #f8f9fa;">
            <div class="text-center mb-4">
                <br>
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAK4AAACUCAMAAAA9M+IXAAAAM1BMVEXk5ueutLenrrHg4+Tn6eqqsbTGysyxt7rJzc/O0dO4vcDa3d67wMK+w8Xe4OK0ur3U19h8wNGYAAAD/ElEQVR4nO2b0XKsIAxARYKKiPL/X1twt7e1XV0gmNC5nIedPp5JIQRMuq7RaDQajUaj0Wg0Go0aAeA2iAS8qTHOObPuf1cMdNINc+9RSoXfeTCyq1QZjLZjr8R3VD9aLSsUhtVu4uj6NFbbUJ2wtOqV66dxVcIgpwvZXVhM1axhMPO17C68rHX4gn7ruvuOrgrf4X1on8ITt6rHxtoK0Q/s8V3ibX18mX1lkq33tZy2kLAS+OMLU59o62HLD2BSYxsYDZOu3DJshZolj250wv3hO7Esh6ylEOg5wgtjrq5Y6MMLLtvW7zZ636x99oD+sIgsw84gT2bJ59khvNRnm0EFVyhiXY0Jrs9lmtQXEBtthziXZdQ2RyhlwaF1KQuz9Dr3F5S5AUasrbKEuhJrKwRlGYnMuoFtJbMFh9clLHOQBcMDutQAE95W0Z1rMDTdO3XRp0SL7rnuH9tqBRKZIkxkf+uYKHIIE94uV7zuTFczdIC2JX1qgAXtS1qeIy/CgvpVGn1XI32FRF/cZ9qL+4RbDYRn2g720YlUtsM+6VHegwN/7cG0Qzw1KEv+dQKVehk+BSJechg+pSCe9XrC6uYbmcmB6yu2yVoObB9ZMz+tOR7bvAs89fF78E1sFmE4zw7IiA6yg+3CKBt8t6TWIWbbDroEX39BY+/Mim92qsG2i+4aqaJJrwstRBELQm0MTQyvATm8bYitq4PXbBcFj+oXrm6sM8As4mWIlRptNevgCwAzLOpXq7xYhgplAwDSaLs95hD2SYTRaiNrH55YndaT1m6tWzQAP+D2OWOXW40JkR12QoCfozR1WYcxHzctJ+9m4+xXcB1DS353rZ/b6yLv+m0nlsnxbjvv6qYwOhNVM/hc4ZOa5tp/AM6O4uWYz4WyXxqavC4LcbWX//8r537WK2EF4TfWtMWtgDNjYR2RsF8ES37r7pfwRjG0BJ1OW65XDDe/PoHUV4ViKkpMd5Y/oJPfFd4J3zcpCGvSJT0afYusLNAi8pJ+Lv86De6e0AZumGwcyuWDV8JzyS0HBp9o3/j25VYwuFtD+xQu9TWoRBtWjO9Wxrd0rj0XLjCamzqeiAKd0Uht8b73ZduX9KiElvqWjwfVDYdv4E8mfxSTKIP99M3MZ6ALlrbxqLw2nbyx2hK+eaOjM4+tyEtnLAv3QcZxXKCJNJv0FgIgPh+OpDZoMGWFf6RmB2zTIJak3VaggxRH2rduyZfEPn1TekoQA+GldFO6pxlKm1++8blX8tsm9Oywb7QH0brsGy2gYo8KqCK4InI1lBiRKUFkC1eJeakSRDYfFhixLkLsaC5+5KQIkTNXaxWJQcSWOUb0dRCZGlZZCVG2jf+VD1jmOR4naw8UAAAAAElFTkSuQmCC" alt="Profile" class="rounded-circle" width="100" height="80">
                <p class="mt-2"><?php echo ($user['firstname'] . ' ' . $user['lastname']) ?></p>
                <button onclick="location.href='../views/login.php'" type="button" class="btn btn-success"
                    style="width: 150px; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: 1.02rem;">
                    Logout
                </button>
            </div>
            <ul class="nav flex-column">
                <li onclick="location.href='../views/sellerDashboard.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Dashboard</li>
                <li onclick="location.href='../views/myProducts.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">My Products</li>
                <li onclick="location.href='../views/sellerOrderDisplay.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Orders</li>
                <li onclick="location.href='../views/settings.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Settings</li>
                <li onclick="location.href='../controllers/switchToBuyer.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Become a Buyer</li>
            </ul>
        </div>


        <!-- Main section -->
        <div class="flex-grow-1 p-4">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <img src="../public/logo.png" class="rounded-circle" style="width:70px;height:70px">
                <h1 class="h4 text-success">My Products</h1>
                <p class="text-muted mb-0" id="currentDate"></p>
                <script>
                    const now = new Date();
                    document.getElementById('currentDate').textContent =
                        now.getUTCDate() + '-' + (now.getUTCMonth() + 1) + '-' + now.getUTCFullYear();
                </script>
            </header>

            <section class="mb-4">
            <div class="p-3 rounded" style="background-color: #e6ffe6;">
                <div class="input-group mt-3">
                    <input oninput="searchProducts(this.value)" name="sellerProducts" type="text" class="form-control" placeholder="Search products">
                    <button class="btn btn-success" >Search</button>
                </div>
            </div>
            </section>



            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 text-success">Product List</h2>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#productModal" onclick="openAddModal()">Add Product</button>
            </div>

            <table id="productTable" class="table table-bordered table-hover">
                <thead style="background-color:#d0f0c0">
                    <tr>
                        <th>Name</th>
                        <th>Desc</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <?php foreach ($products as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['name']) ?></td>
                            <td><?= htmlspecialchars($p['description']) ?></td>
                            <td><?= htmlspecialchars($p['category']) ?></td>
                            <td>$<?= number_format($p['price'], 2) ?></td>
                            <td><?= $p['stock'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary" onclick='openEditModal(<?= json_encode($p) ?>)'>Edit</button>
                                <button class="btn btn-sm btn-outline-danger" onclick='deleteProduct(<?= $p['product_id'] ?>)'>Delete</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="../controllers/saveProduct.php" class="modal-content">
                <div class="modal-header" style="background-color:#d0f0c0">
                    <h5 class="modal-title text-success" id="productModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="mb-3"><label class="form-label">Name</label><input id="product_name" name="name" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Description</label><textarea id="product_desc" name="description" class="form-control" required></textarea></div>
                    <div class="mb-3"><label class="form-label">Category</label>
                        <select id="product_cat" name="category" class="form-select" required>
                            <option value="">Select category</option>
                            <?php foreach ($categories as $c): ?>
                                <option><?= htmlspecialchars($c) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Price ($)</label><input type="number" step="0.01" id="product_price" name="price" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Stock</label><input type="number" id="product_stock" name="stock" class="form-control" required></div>
                </div>
                <div class="modal-footer" style="background-color:#fdf8df">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openAddModal() {
                    document.getElementById('productModalLabel').textContent = 'Add';
                    ['product_id', 'product_name', 'product_desc', 'product_price', 'product_stock'].forEach(id => document.getElementById(id).value = '');
                    document.getElementById('product_cat').value = '';
        }

        function openEditModal(prod) {
            document.getElementById('productModalLabel').textContent = 'Edit Product';
            document.getElementById('product_id').value = prod.product_id;
            document.getElementById('product_name').value = prod.name;
            document.getElementById('product_desc').value = prod.description;
            document.getElementById('product_price').value = prod.price;
            document.getElementById('product_stock').value = prod.stock;
            document.getElementById('product_cat').value = prod.category;
            new bootstrap.Modal(document.getElementById('productModal')).show();
        }

        function deleteProduct(id) {
            if (!confirm('Delete this product?')) return;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '../controllers/saveProduct.php';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_id';
            input.value = id;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }


        function searchProducts(query) {
            const rows = document.querySelectorAll("#productTableBody tr");
            const lowerQuery = query.toLowerCase();

            rows.forEach(row => {
                const cells = row.querySelectorAll("td");
                const rowText = Array.from(cells).map(td => td.textContent.toLowerCase()).join(" ");
                row.style.display = rowText.includes(lowerQuery) ? "" : "none";
            });
        }


    </script>

</body>

</html>