<?php
include '../db.php';

// Get student ID from URL
$id = $_GET['id'] ?? 0;

// If form is submitted (user confirmed)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Delete the student
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    // Redirect to student list
    header("Location: index.php");
    exit();
}

// Fetch student data to show in confirmation
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// If no student found, go back to list
if (!$student) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f0f2f5; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; text-align: center; }
        h1 { color: #dc3545; }
        .info { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0; text-align: left; }
        .warning { color: #dc3545; font-weight: bold; }
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-danger:hover { background: #c82333; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-secondary:hover { background: #5a6268; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗑️ Delete Student</h1>
        <p class="warning">⚠️ Are you sure you want to delete this student?</p>
        
        <!-- Show student details -->
        <div class="info">
            <p><strong>Student ID:</strong> <?= htmlspecialchars($student['student_id']) ?></p>
            <p><strong>Name:</strong> <?= htmlspecialchars($student['fullname']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
            <p><strong>Course:</strong> <?= htmlspecialchars($student['course']) ?></p>
        </div>
        
        <p style="color: #dc3545; font-weight: bold;">This action cannot be undone!</p>
        
        <form method="post">
            <button type="submit" class="btn btn-danger">🗑️ Confirm Delete</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>