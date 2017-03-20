<?php

$servername = "localhost";
$username = "icoolsho_supreti";
$password = "AD320";
$dbname = "icoolsho_supreti";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8mb4');

?>