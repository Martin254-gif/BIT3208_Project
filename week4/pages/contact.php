<?php
session_start();
include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'Contact Us';
$message_sent = false;
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $subject = sanitizeInput($_POST['subject']);
    $message = sanitizeInput($_POST['message']);
    
    // Validation
    $errors = [];
    
    if (empty($name) || strlen($name) < 3) {
        $errors[] = "Name must be at least 3 characters";
    }
    
    if (empty($email) || !validateEmail($email)) {
        $errors[] = "Please enter a valid email address";
    }
    
    if (empty($subject) || strlen($subject) < 3) {
        $errors[] = "Subject must be at least 3 characters";
    }
    
    if (empty($message) || strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters";
    }
    
    if (empty($errors)) {
        // In a real application, you would save to database or send email
        $message_sent = true;
    } else {
        $error = implode("<br>", $errors);
    }
}

include '../includes/header.php';
?>

<div class="container">
    <h1>📧 Contact Us</h1>
    
    <?php if ($message_sent): ?>
        <div class="alert alert-success">
            ✅ Your message has been sent successfully! We'll get back to you soon.
        </div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required>
        </div>
        
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>