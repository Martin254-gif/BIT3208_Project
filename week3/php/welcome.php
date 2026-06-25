<?php
// Dynamic Welcome Page
// This file processes user input and displays a welcome message

// Check if the form was submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    // Basic validation
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // If no errors, display welcome message
    if (empty($errors)) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Welcome</title>
            <style>
                body { font-family: Arial; text-align: center; padding: 50px; }
                .welcome { background: #e8f5e9; padding: 40px; border-radius: 10px; }
            </style>
        </head>
        <body>
            <div class='welcome'>
                <h1>🎉 Welcome, " . htmlspecialchars($username) . "!</h1>
                <p>We've sent a confirmation to: " . htmlspecialchars($email) . "</p>
                <p><a href='welcome.php'>Go Back</a></p>
            </div>
        </body>
        </html>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
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
            max-width: 400px;
        }
        h1 { text-align: center; color: #1a73e8; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover { background: #1557b0; }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome Form</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p>❌ <?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter your username">
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email">
            </div>
            
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>