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

$page_title = 'Edit Student';
$message = '';
$error = '';
$courses = getCourses();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'fullname' => sanitize($_POST['fullname']),
        'email' => sanitize($_POST['email']),
        'phone' => sanitize($_POST['phone'] ?? ''),
        'course' => sanitize($_POST['course'])
    ];
    
    $errors = [];
    if (empty($data['fullname'])) $errors[] = "Full name is required";
    if (empty($data['email'])) $errors[] = "Email is required";
    if (empty($data['course'])) $errors[] = "Course is required";
    
    if (empty($errors)) {
        if (updateStudent($id, $data)) {
            $message = "✅ Student updated successfully!";
            $student = getStudentById($id);
        } else {
            $error = "❌ Error: " . $conn->error;
        }
    } else {
        $error = "❌ " . implode("<br>", $errors);
    }
}

include '../includes/header.php';
?>

<div class="container">
    <h1>✏️ Edit Student</h1>
    
    <?php if ($message): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label>Student ID</label>
            <input type="text" value="<?php echo htmlspecialchars($student['student_id']); ?>" readonly>
        </div>
        
        <div class="form-group">
            <label>Full Name *</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($student['fullname']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>">
        </div>
        
        <div class="form-group">
            <label>Course *</label>
            <select name="course" required>
                <option value="">-- Select Course --</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?php echo $course; ?>" <?php echo ($student['course'] == $course) ? 'selected' : ''; ?>>
                        <?php echo $course; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-warning">💾 Update Student</button>
        <a href="students.php" class="btn btn-primary">← Back</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>