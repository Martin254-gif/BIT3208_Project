<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'Register';
$message = '';
$error = '';

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = sanitize($_POST['fullname']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'] ?? 'student';
    
    // Validation
    $errors = [];
    if (empty($fullname) || strlen($fullname) < 3) {
        $errors[] = "Full name must be at least 3 characters";
    }
    if (empty($email) || !validateEmail($email)) {
        $errors[] = "Please enter a valid email address";
    }
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    if (empty($errors)) {
        $result = registerUser($fullname, $email, $password, $role);
        if ($result['success']) {
            $message = $result['message'];
            // Clear form
            $fullname = $email = '';
        } else {
            $error = $result['message'];
        }
    } else {
        $error = implode("<br>", $errors);
    }
}

include '../includes/header.php';
?>

<div class="container">
    <h1>📝 Create Account</h1>
    
    <?php if ($message): ?>
        <?php echo displayMessage($message, 'success'); ?>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <?php echo displayMessage($error, 'error'); ?>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label>Full Name *</label>
            <input type="text" name="fullname" value="<?php echo $fullname ?? ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" value="<?php echo $email ?? ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label>Password (min 6 chars) *</label>
            <input type="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label>Confirm Password *</label>
            <input type="password" name="confirm_password" required>
        </div>
        
        <div class="form-group">
            <label>Role</label>
            <select name="role">
                <option value="student">🎓 Student</option>
                <option value="lecturer">👨‍🏫 Lecturer</option>
                <option value="admin">🛡️ Administrator</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
    
    <p style="text-align: center; margin-top: 1rem;">
        Already have an account? <a href="login.php">Login here</a>
    </p>
</div>

<?php include '../includes/footer.php'; ?>