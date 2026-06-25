<?php
// Start session
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    
    // Validation
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields";
    } else {
        // Check user in database
        $sql = "SELECT id, fullname, email, password_hash, role FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password_hash'])) {
                // Login successful - create session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid email or password";
            }
        } else {
            $error = "Invalid email or password";
        }
        $stmt->close();
    }
}

include '../includes/header.php';
?>

<div class="container login-container">
    <h1>🔐 Sign In</h1>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
    
    <p class="text-center">Don't have an account? <a href="register.php">Register here</a></p>
    
    <div class="demo-credentials">
        <h4>Demo Credentials:</h4>
        <p><strong>Email:</strong> admin@example.com</p>
        <p><strong>Password:</strong> admin123</p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>