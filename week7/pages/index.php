<?php
session_start();
$page_title = 'Home';
include '../includes/header.php';
?>

<div style="text-align: center; padding: 3rem 0;">
    <h1 style="color: #1a73e8; font-size: 2.5rem;">🎓 Student Management System</h1>
    <p style="font-size: 1.2rem; color: #666; margin: 1rem 0;">
        Efficiently manage students, courses, and user authentication
    </p>
    
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php" class="btn btn-primary" style="font-size: 1.1rem; padding: 0.75rem 2rem;">
                🚀 Go to Dashboard
            </a>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary" style="font-size: 1.1rem; padding: 0.75rem 2rem;">
                🔐 Login
            </a>
            <a href="register.php" class="btn btn-success" style="font-size: 1.1rem; padding: 0.75rem 2rem;">
                📝 Register
            </a>
        <?php endif; ?>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 3rem; text-align: left;">
        <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="color: #1a73e8;">👥 Student Management</h3>
            <p>Add, edit, and delete student records efficiently.</p>
        </div>
        <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="color: #1a73e8;">🔐 Secure Authentication</h3>
            <p>Login, register, and role-based access control.</p>
        </div>
        <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h3 style="color: #1a73e8;">📊 Dashboard</h3>
            <p>Real-time statistics and overview of your system.</p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>