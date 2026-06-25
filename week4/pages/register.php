<?php
// Start session for any messages
session_start();

// Include database connection
include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'Register';
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize form data
    $fullname = sanitizeInput($_POST['fullname']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
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
    
    // If no errors, proceed with registration
    if (empty($errors)) {
        // Check if email already exists
        $check_sql = "SELECT id FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            $error = "Email already registered. Please login.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user into database
            $insert_sql = "INSERT INTO users (fullname, email, password_hash, role) VALUES (?, ?, ?, 'student')";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("sss", $fullname, $email, $hashed_password);
            
            if ($insert_stmt->execute()) {
                $success = "Registration successful! Please login.";
                // Clear form data
                $fullname = $email = '';
            } else {
                $error = "Registration failed. Please try again.";
            }
            $insert_stmt->close();
        }
        $check_stmt->close();
    } else {
        $error = implode("<br>", $errors);
    }
}

include '../includes/header.php';
?>

<div class="container">
    <h1>📝 Create an Account</h1>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $fullname ?? ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="<?php echo $email ?? ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password (min 6 characters)</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    
    <p class="text-center">Already have an account? <a href="login.php">Login here</a></p>
</div>

<?php include '../includes/footer.php'; ?>