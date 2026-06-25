<?php
include '../db.php';

// Get the student ID from URL
$id = $_GET['id'] ?? 0;
$message = '';
$error = '';

// Fetch current student data
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// If no student found, redirect to list
if (!$student) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $phone = $_POST['phone'] ?? '';
    
    // Validate
    $errors = [];
    if (empty($fullname)) $errors[] = "Full name is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($course)) $errors[] = "Course is required";
    
    if (empty($errors)) {
        // Update database
        $stmt = $conn->prepare("UPDATE students SET fullname=?, email=?, phone=?, course=? WHERE id=?");
        $stmt->bind_param("ssssi", $fullname, $email, $phone, $course, $id);
        
        if ($stmt->execute()) {
            $message = "✅ Student updated successfully!";
            // Refresh data
            $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $student = $result->fetch_assoc();
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
    <title>Edit Student</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f0f2f5; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; }
        h1 { color: #1a73e8; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { padding: 10px 20px; background: #ffc107; color: black; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #e0a800; }
        .message { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .back { display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Edit Student</h1>
        
        <?php if ($message): ?>
            <div class="message success"><?= $message ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="message error"><?= $error ?></div>
        <?php endif; ?>
        
        <form method="post">
            <div class="form-group">
                <label>Student ID</label>
                <input type="text" value="<?= htmlspecialchars($student['student_id']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="fullname" value="<?= htmlspecialchars($student['fullname']) ?>" required>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($student['phone']) ?>">
            </div>
            <div class="form-group">
                <label>Course *</label>
                <select name="course" required>
                    <option value="">-- Select Course --</option>
                    <option <?= $student['course'] == 'Computer Science' ? 'selected' : '' ?>>Computer Science</option>
                    <option <?= $student['course'] == 'Business Administration' ? 'selected' : '' ?>>Business Administration</option>
                    <option <?= $student['course'] == 'Engineering' ? 'selected' : '' ?>>Engineering</option>
                    <option <?= $student['course'] == 'Mathematics' ? 'selected' : '' ?>>Mathematics</option>
                    <option <?= $student['course'] == 'Physics' ? 'selected' : '' ?>>Physics</option>
                    <option <?= $student['course'] == 'Biology' ? 'selected' : '' ?>>Biology</option>
                    <option <?= $student['course'] == 'Economics' ? 'selected' : '' ?>>Economics</option>
                </select>
            </div>
            <button type="submit" class="btn">💾 Update Student</button>
        </form>
        <a href="index.php" class="back">← Back to Student List</a>
    </div>
</body>
</html>