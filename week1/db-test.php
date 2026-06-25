<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';          // default is empty on XAMPP
$database = 'student_system';

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
echo "✅ Connected successfully to the database!";
$conn->close();
?>