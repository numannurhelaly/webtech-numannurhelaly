<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>

<?php
echo "Welcome, " . $_SESSION['user_name'] . "!";

// Show last login cookie
if (isset($_COOKIE['last_login'])) {
    echo "<br>Last Login: " . $_COOKIE['last_login'];
}
?>

<br><br>
<a href="logout.php">Logout</a>

</body>
</html>