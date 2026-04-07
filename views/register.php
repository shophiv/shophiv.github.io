<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h2>Register</h2>
<form action="../controllers/authController.php" method="POST">
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
    <button class="btn btn-primary" type="submit" name="register">Register</button>
</form>
<h3 style="margin-top: 10px;">Already have an Account ? Login:</h3>

    <button class="btn btn-primary" onclick="location.href='login.php'" style="margin-top: 10px;" >Login</button>
</body>
</html>