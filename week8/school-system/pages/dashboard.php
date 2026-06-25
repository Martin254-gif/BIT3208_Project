<?php
include '../includes/auth.php';
checkAuth();

include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'Dashboard';
$user = getUserById($_SESSION['user_id']);

include '../includes/header.php';
?>

<div class="dashboard">
    <div class="welcome-card">
        <h1>👋 Welcome, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</h1>
        <span class="role-badge"><?php echo getRoleLabel($_SESSION['role']); ?></span>
    </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="number">150</div>
            <p>Total Students</p>
        </div>
        <div class="stat-card">
            <div class="number">12</div>
            <p>Total Courses</p>
        </div>
        <div class="stat-card">
            <div class="number">5</div>
            <p>New This Week</p>
        </div>
    </div>
    
    <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 1rem;">
        <?php if (userHasRole('admin')): ?>
            <a href="../students.php" class="btn btn-primary">👥 Manage Students</a>
            <a href="#" class="btn btn-success">📊 Reports</a>
        <?php endif; ?>
        <?php if (userHasRole('lecturer')): ?>
            <a href="#" class="btn btn-primary">📝 My Courses</a>
        <?php endif; ?>
        <?php if (userHasRole('student')): ?>
            <a href="#" class="btn btn-primary">📚 My Courses</a>
            <a href="#" class="btn btn-success">📊 My Grades</a>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>