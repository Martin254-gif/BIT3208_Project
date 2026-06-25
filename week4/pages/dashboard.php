<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'Dashboard';

// Get user info
$user_id = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];
$role = $_SESSION['role'];

include '../includes/header.php';
?>

<div class="dashboard">
    <h1>📊 Welcome back, <?php echo htmlspecialchars($fullname); ?>!</h1>
    
    <div class="role-badge">
        Role: <?php echo ucfirst(htmlspecialchars($role)); ?>
    </div>
    
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>👥 Total Students</h3>
            <p class="stat-number">0</p>
        </div>
        <div class="stat-card">
            <h3>📚 Courses</h3>
            <p class="stat-number">0</p>
        </div>
        <div class="stat-card">
            <h3>📝 Recent Activity</h3>
            <p class="stat-number">0</p>
        </div>
    </div>
    
    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="action-buttons">
            <a href="#" class="btn btn-primary">➕ Add Student</a>
            <a href="#" class="btn btn-secondary">👥 View All Students</a>
            <a href="#" class="btn btn-success">📊 Generate Report</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>