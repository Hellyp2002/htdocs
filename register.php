<?php
header('Content-Type: application/json');

$servername = "localhost"; // Replace with your server name
$username = "root";        // Replace with your database username
$password = "1234";            // Replace with your database password
$dbname = "handy_library"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

// Get data from POST request
$university = $_POST['university'];
$email = $_POST['email'];
$location = $_POST['location'];
$password = $_POST['password'];
$username = $_POST['username'];

// Validate inputs
if (empty($university) || empty($email) || empty($location) || empty($password) || empty($username)) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit();
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insert data into the database
$sql = "INSERT INTO users (university, email, location, password, username) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $university, $email, $location, $hashedPassword, $username);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Registration failed']);
}

$stmt->close();
$conn->close();
?>
