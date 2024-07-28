<?php

session_start();
include("includes/connection.php");
$user = $_SESSION['user_name'];
// mysqli_query($conn, "UPDATE users SET log_in = 0 WHERE user_name = '$user'");
if(isset($_SESSION['user_name'])){

    unset($_SESSION['user_name']);
    unset($_SESSION['receiver']);

}

header("Location: login.php");
die;