<?php
// Include database connection
include '../db.php';

// Variables for messages
$message = '';
$error = '';

// Generate a unique student ID: STU + Year + 4-digit number
$student_id = 'STU' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $phone = $_POST['phone'] ?? ''; // If empty, use empty string
    
    // Validate (basic checks)
    $errors = [];
    if (empty($fullname)) $errors[] = "Full name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($course)) $errors[] = "Course is required";
    
    // If no errors, insert into database
    if (empty($errors)) {
        // Prepare SQL statement (prevents SQL injection)
        $stmt = $conn->prepare("INSERT INTO students (student_id, fullname, email, phone, course) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $student_id, $fullname, $email, $phone, $course);
        
        if ($stmt->execute()) {
            $message = "✅ Student added successfully! ID: $student_id";
            // Generate new ID for next student
            $student_id = 'STU' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } else {
            $error = "❌ Error: " . $conn->error;
        }
    } else {
        $error = "❌ " . implode("<br>", $errors);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f0f2f5; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        h1 { color: #1a73e8; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 10px 20px; background: #1a73e8; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #1557b0; }
        .message { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .back { display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>➕ Add New Student</h1>
        
        <!-- Display success or error message -->
        <?php if ($message): ?>
            <div class="message success"><?= $message ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>
        
        <!-- The form -->
        <form method="post">
            <div class="form-group">
                <label>Student ID (Auto-generated)</label>
                <input type="text" value="<?= $student_id ?>" readonly>
            </div>
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="fullname" required>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Phone (Optional)</label>
                <input type="text" name="phone">
            </div>
            <div class="form-group">
                <label>Course *</label>
                <select name="course" required>
                    <option value="">-- Select Course --</option>
                    <option>Computer Science</option>
                    <option>Business Administration</option>
                    <option>Engineering</option>
                    <option>Mathematics</option>
                    <option>Physics</option>
                    <option>Biology</option>
                    <option>Economics</option>
                </select>
            </div>
            <button type="submit" class="btn">💾 Save Student</button>
        </form>
        <a href="index.php" class="back">← Back to Student List</a>
    </div>
</body>
</html>