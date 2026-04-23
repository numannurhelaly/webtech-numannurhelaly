<?php
$email_cookie = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form action="login_process.php" method="POST">
    Email: <input type="email" name="email" value="<?php echo $email_cookie; ?>" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<a href="register.php">Register</a>

</body>
</html>