<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h2>Register</h2>
<form action="../controllers/authSeller.php" method="POST">
    <div class="mb-3">
        <input class="form-control" type="text" name="fname" placeholder="First Name" required />
    </div>
    <div class="mb-3">
        <input class="form-control" type="text" name="lname" placeholder="Last Name" required />
    </div>
    <div class="mb-3">
        <input class="form-control" type="email" name="email" placeholder="Email" required />
    </div>
    <div class="mb-3">
         <input class="form-control" type="tel" name="phone" placeholder="Phone Number" required />
    </div>
    <div class="mb-3">
        <input class="form-control" type="password" name="password" placeholder="Password" required />
    </div>
    <button class="btn btn-primary" type="submit" name="registerAsSeller">Register As Seller</button>
</form>
</body>
</html>