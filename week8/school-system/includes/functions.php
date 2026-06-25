<?php
// Helper Functions

// Sanitize input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Verify password
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Get user data
function getUserById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Register new user
function registerUser($fullname, $email, $password, $role = 'student') {
    global $conn;
    
    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        return ['success' => false, 'message' => 'Email already registered'];
    }
    
    // Hash password and insert
    $hashed = hashPassword($password);
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password_hash, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $hashed, $role);
    
    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Registration successful!'];
    } else {
        return ['success' => false, 'message' => 'Registration failed: ' . $conn->error];
    }
}

// Login user
function loginUser($email, $password) {
    global $conn;
    
    // Get user by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        return ['success' => false, 'message' => 'User not found'];
    }
    
    $user = $result->fetch_assoc();
    
    // Verify password
    if (!verifyPassword($password, $user['password_hash'])) {
        return ['success' => false, 'message' => 'Invalid password'];
    }
    
    // Create session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['fullname'] = $user['fullname'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    
    return ['success' => true, 'message' => 'Login successful!', 'role' => $user['role']];
}

// Logout user
function logoutUser() {
    session_start();
    session_destroy();
    return true;
}

// Check user role
function userHasRole($requiredRole) {
    if (!isLoggedIn()) {
        return false;
    }
    return $_SESSION['role'] === $requiredRole;
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

// Redirect if not admin
function requireAdmin() {
    requireLogin();
    if (!userHasRole('admin')) {
        header("Location: dashboard.php");
        exit();
    }
}

// Get role label
function getRoleLabel($role) {
    $roles = [
        'admin' => '🛡️ Administrator',
        'lecturer' => '👨‍🏫 Lecturer',
        'student' => '🎓 Student'
    ];
    return $roles[$role] ?? $role;
}

// Display messages
function displayMessage($message, $type = 'info') {
    $classes = [
        'success' => 'alert-success',
        'error' => 'alert-error',
        'info' => 'alert-info'
    ];
    $class = $classes[$type] ?? 'alert-info';
    return "<div class='alert $class'>$message</div>";
}
?>