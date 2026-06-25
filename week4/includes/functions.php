<?php
// Helper Functions

// Sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Display error messages
function displayError($message) {
    return '<div class="alert alert-error">❌ ' . $message . '</div>';
}

// Display success messages
function displaySuccess($message) {
    return '<div class="alert alert-success">✅ ' . $message . '</div>';
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect to a page
function redirect($url) {
    header("Location: " . $url);
    exit();
}
?>