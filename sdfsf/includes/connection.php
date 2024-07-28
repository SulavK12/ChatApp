<?php 

$dbhost = "localhost";
$dbuser = "id16237137_sajan";
$dbpass = "S@jan9999999";
$dbname = "id16237137_login";

if(!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    die("Failed to connect to database");
}

