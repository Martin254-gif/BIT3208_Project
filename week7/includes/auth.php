<?php
// Authentication middleware
session_start();

// Check if user is logged in
function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

// Check if user has specific role
function checkRole($requiredRole) {
    checkAuth();
    if ($_SESSION['role'] !== $requiredRole) {
        header("Location: dashboard.php");
        exit();
    }
}
?>