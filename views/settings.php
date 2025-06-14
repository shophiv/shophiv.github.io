<?php
require_once '../config/db.php';
session_start();

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Settings</title>
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
                <li onclick="location.href='../controllers/sessionHandle.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Dashboard</li>
                <li onclick="location.href='../public/index.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Product Catalog</li>
                <li onclick="location.href='../views/settings.php'" style="margin-bottom: 10px;padding: 10px;background-color: #d0f0c0; border-radius: 5px" class="nav-item btn btn-light mb-2">Settings</li>
            </ul>
        </div>


        <!-- Main section -->
        <div class="flex-grow-1 p-4">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <img src="../public/logo.png" class="rounded-circle" style="width:70px;height:70px">
                <h1 class="h4 text-success">Settings</h1>
                <p class="text-muted mb-0" id="currentDate"></p>
                <script>
                    const now = new Date();
                    document.getElementById('currentDate').textContent =
                    now.getUTCDate() + '-' + (now.getUTCMonth() + 1) + '-' + now.getUTCFullYear();
                </script>
            </header>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 text-success">User Profile</h2>
            </div>

            <div class="container mt-5">
                <div class="row justify-content-left">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0 p-4">

                            <h4><strong>Name: </strong> <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></h4>
                            <h4><strong>Email: </strong> <?= htmlspecialchars($user['email'] ?? 'example@gmail.com') ?></h4>
                            <h4><strong>Role: </strong> <?= htmlspecialchars($_SESSION['role'] ?? 'Not specified') ?></h4>
                            <h4><strong>Phone: </strong> <?= htmlspecialchars($user['phone'] ?? '???') ?></h4>
                            <h4><strong>Street:</strong> <?= htmlspecialchars($user['street'] ?? '???') ?></h4>
                            <h4><strong>City:</strong> <?= htmlspecialchars($user['city'] ?? '???') ?></h4>
                            <h4><strong>State:</strong> <?= htmlspecialchars($user['state'] ?? '???') ?></h4>

                            <div class="text-end mt-4">
                                 <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#productModal" onclick="openEditModal()">Edit Profile</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <form  method="POST" action="../controllers/updateUser.php" class="modal-content">
                <div class="modal-header" style="background-color:#d0f0c0">
                    <h5 class="modal-title text-success" id="productModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="mb-3"><label class="form-label">First Name</label><input id="firstname" name="firstname" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Last Name</label><input id="lastname" name="lastname" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Email</label><input type="email" id="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">password</label><input type="password" id="password" name="password" placeholder="Your Password" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Phone Number</label><input type="tel" id="phone" name="phone" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">street</label><input id="street" name="street" class="form-control" ></div>
                    <div class="mb-3"><label class="form-label">City</label><input id="city" name="city" class="form-control" ></div>
                    <div class="mb-3"><label class="form-label">State</label><input id="state" name="state" class="form-control" ></div>
                </div>
                <div class="modal-footer" style="background-color:#fdf8df">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button name="update" type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal() {
            const u = <?= json_encode($user) ?>;
            document.getElementById('productModalLabel').textContent = 'Edit Profile';
            document.getElementById('firstname').value = u.firstname;
            document.getElementById('lastname').value = u.lastname;
            document.getElementById('email').value = u.email;
            document.getElementById('phone').value = u.phone;
            document.getElementById('city').value = u.city;
            document.getElementById('state').value = u.state;
            document.getElementById('street').value = u.street;
            document.getElementById('zip_code').value = u.zip_code;
            new bootstrap.Modal(document.getElementById('productModal')).show();
        }
    </script>

</body>

</html>