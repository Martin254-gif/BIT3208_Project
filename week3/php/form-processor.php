<?php
// Simple Form Processor
// This file processes data from a contact form

// Check if the form was submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data and sanitize
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Validate data
    $errors = [];
    
    if (empty($name) || strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($message) || strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters";
    }
    
    // If no errors, process the data
    if (empty($errors)) {
        // In a real application, you would save to database or send email
        $success = true;
        $response_data = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Processor</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 { text-align: center; color: #1a73e8; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        textarea { resize: vertical; min-height: 100px; }
        button {
            width: 100%;
            padding: 12px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover { background: #1557b0; }
        .error { color: red; margin-bottom: 10px; }
        .success {
            background: #e8f5e9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .success h3 { color: #28a745; }
        .back-link { display: block; text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📧 Contact Form</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p>❌ <?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($success) && $success): ?>
            <div class="success">
                <h3>✅ Message Sent Successfully!</h3>
                <p><strong>Name:</strong> <?php echo $response_data['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $response_data['email']; ?></p>
                <p><strong>Message:</strong> <?php echo $response_data['message']; ?></p>
                <p><strong>Sent at:</strong> <?php echo $response_data['timestamp']; ?></p>
            </div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter your name">
            </div>
            
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email">
            </div>
            
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" placeholder="Enter your message (at least 10 characters)"></textarea>
            </div>
            
            <button type="submit">Send Message</button>
        </form>
        
        <a href="../index.php" class="back-link">← Back to Main</a>
    </div>
</body>
</html>