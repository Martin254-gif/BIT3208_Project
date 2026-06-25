<?php
include '../includes/auth.php';
checkAuth();

include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'Profile';
$user = getUserById($_SESSION['user_id']);

include '../includes/header.php';
?>

<div class="container">
    <h1>👤 My Profile</h1>
    
    <div class="profile-info">
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Role:</strong> <?php echo getRoleLabel($user['role']); ?></p>
        <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
    </div>
    
    <div style="margin-top: 1.5rem; text-align: center;">
        <a href="dashboard.php" class="btn btn-primary">← Back to Dashboard</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>