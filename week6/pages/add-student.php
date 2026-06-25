<?php
session_start();
include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'Add Student';
$message = '';
$error = '';
$student_id = generateStudentId();
$courses = getCourses();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'student_id' => $_POST['student_id'],
        'fullname' => sanitize($_POST['fullname']),
        'email' => sanitize($_POST['email']),
        'phone' => sanitize($_POST['phone'] ?? ''),
        'course' => sanitize($_POST['course'])
    ];
    
    // Validation
    $errors = [];
    if (empty($data['fullname'])) $errors[] = "Full name is required";
    if (empty($data['email'])) $errors[] = "Email is required";
    if (empty($data['course'])) $errors[] = "Course is required";
    
    if (empty($errors)) {
        if (addStudent($data)) {
            $message = "✅ Student added successfully! ID: {$data['student_id']}";
            $student_id = generateStudentId();
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
    <h1>➕ Add New Student</h1>
    
    <?php if ($message): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label>Student ID (Auto-generated)</label>
            <input type="text" value="<?php echo $student_id; ?>" readonly>
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
        </div>
        
        <div class="form-group">
            <label>Full Name *</label>
            <input type="text" name="fullname" value="<?php echo $_POST['fullname'] ?? ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo $_POST['phone'] ?? ''; ?>">
        </div>
        
        <div class="form-group">
            <label>Course *</label>
            <select name="course" required>
                <option value="">-- Select Course --</option>
                <?php foreach ($courses as $course): ?>
                    <option value="<?php echo $course; ?>" <?php echo (($_POST['course'] ?? '') == $course) ? 'selected' : ''; ?>>
                        <?php echo $course; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">💾 Save Student</button>
        <a href="students.php" class="btn btn-primary">← Back</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>