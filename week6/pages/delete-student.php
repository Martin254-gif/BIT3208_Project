<?php
session_start();
include '../includes/db-connect.php';
include '../includes/functions.php';

$id = $_GET['id'] ?? 0;
$student = getStudentById($id);

if (!$student) {
    header("Location: students.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (deleteStudent($id)) {
        header("Location: students.php?deleted=1");
        exit();
    }
}

$page_title = 'Delete Student';
include '../includes/header.php';
?>

<div class="container" style="text-align: center;">
    <h1>🗑️ Delete Student</h1>
    
    <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; margin: 1.5rem 0; text-align: left;">
        <p><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($student['fullname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($student['course']); ?></p>
    </div>
    
    <p style="color: #dc3545; font-weight: bold; font-size: 1.1rem;">⚠️ This action cannot be undone!</p>
    
    <form method="post">
        <button type="submit" class="btn btn-danger">🗑️ Confirm Delete</button>
        <a href="students.php" class="btn btn-primary">Cancel</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>