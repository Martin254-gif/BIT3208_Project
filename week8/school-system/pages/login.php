<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'Login';
$error = '';

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields";
    } else {
        $result = loginUser($email, $password);
        if ($result['success']) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = $result['message'];
        }
    }
}

include '../includes/header.php';
?>

<div class="container">
    <h1>🔐 Sign In</h1>
    
    <?php if ($error): ?>
        <?php echo displayMessage($error, 'error'); ?>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </form>
    
    <div style="margin-top: 1.5rem; padding: 1rem; background: #f8f9fa; border-radius: 5px;">
        <p style="text-align: center; font-weight: bold; color: #333;">Demo Credentials:</p>
        <ul style="list-style: none; padding: 0; text-align: center;">
            <li><strong>Admin:</strong> admin@example.com / password123</li>
            <li><strong>Lecturer:</strong> lecturer@example.com / password123</li>
            <li><strong>Student:</strong> student@example.com / password123</li>
        </ul>
    </div>
    
    <p style="text-align: center; margin-top: 1rem;">
        Don't have an account? <a href="register.php">Register here</a>
    </p>
</div>

<?php include '../includes/footer.php'; ?>