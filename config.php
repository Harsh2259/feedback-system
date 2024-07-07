<?php
$server = "sql123.infinityfree.net";  // Or the specific server provided by your hosting service
$username = "epiz_12345678";
$password = "yourpassword";
$dbname = "epiz_12345678_exampledb";

// Create connection
$con = new mysqli($server, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
