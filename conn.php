<?php

header("Access-Control-allow-origin");
// Database credentials
$host = 'localhost';
$username = 'root';
$password = '1234'; // Replace with your database password
$database = 'handy_library';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}
?>