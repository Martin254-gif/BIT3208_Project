<?php
// Database connection configuration
$host = 'localhost';      // Your database server (local)
$user = 'root';           // Default XAMPP username
$pass = '';               // Default XAMPP password (empty)
$dbname = 'student_system'; // Name of your database

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check if connection worked
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// If we get here, connection is successful
?>