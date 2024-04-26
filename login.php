<?php
// Database connection
require "db_connect.php";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data
$username = $_POST['u'];
$password = $_POST['p'];

// SQL to check username and password
$sql = "SELECT * FROM login_user WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: dashboard.php");
    exit;
} else {
    echo "Invalid username or password";
}

$conn->close();
?>
