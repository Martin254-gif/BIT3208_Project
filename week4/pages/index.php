<?php
session_start();
$page_title = 'Home';
include '../includes/header.php';
?>

<div class="hero">
    <h1>Welcome to Student Management System</h1>
    <p>Efficiently manage students, courses, and academic records</p>
    
    <div class="hero-buttons">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-secondary">Register</a>
        <?php endif; ?>
    </div>
</div>

<div class="features">
    <div class="feature-card">
        <h3>👥 Student Management</h3>
        <p>Add, edit, and delete student records</p>
    </div>
    <div class="feature-card">
        <h3>📚 Course Management</h3>
        <p>Manage courses and assignments</p>
    </div>
    <div class="feature-card">
        <h3>📊 Reports</h3>
        <p>Generate detailed student reports</p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>