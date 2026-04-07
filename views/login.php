<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h2>Login</h2>
<form action="../controllers/authController.php" method="POST">
    <div class="mb-3">
        <input class="form-control" type="email" name="email" placeholder="Email" required />
    </div>
    <div class="mb-3">
        <input class="form-control" type="password" name="password" placeholder="Password" required />
    </div>
    <button class="btn btn-primary" type="submit" name="login">Login</button>
</form>
<h3 style="margin-top: 10px;">If Account doesn't exist, then please signup:</h3>
<button onclick="location.href='../views/register.php'" style="margin-top: 10px;" class="btn btn-primary" >signup</button>
</body>
</html>