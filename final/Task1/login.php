<?php
session_start();
include("users.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username])) {

        if (password_verify($password, $users[$username])) {

            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();

        } else {
            echo "Wrong Password!";
        }

    } else {
        echo "User not found!";
    }
}
?>