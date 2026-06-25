<?php
// Database Connection Script
// This file connects PHP to MySQL database

// Database configuration
$host = 'localhost';
$username = 'root';          // Default XAMPP username
$password = '';              // Default XAMPP password (empty)
$database = 'student_system'; // Database name from Week 1

// Create connection using mysqli
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Connected successfully to the database!<br>";
    echo "Database: " . $database . "<br>";
    echo "Host: " . $host . "<br>";
}

// Optional: Display server info
echo "Server version: " . $conn->server_info . "<br>";

// Close connection (optional - but good practice)
// $conn->close();
?>