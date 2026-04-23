<?php
session_start();
include("db.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        // Session set
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        // Cookie: save email (7 days)
        setcookie("user_email", $email, time() + (7 * 24 * 60 * 60));

        // Cookie: last login time
        setcookie("last_login", date("Y-m-d H:i:s"), time() + (7 * 24 * 60 * 60));

        header("Location: dashboard.php");
        exit();

    } else {
        echo "❌ Wrong password!";
    }

} else {
    echo "❌ User not found!";
}
?>