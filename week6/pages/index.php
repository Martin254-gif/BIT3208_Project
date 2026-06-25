<?php
session_start();
include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'Dashboard';

// Get stats
$total_students = getTotalStudents();
$total_courses = getTotalCourses();
$recent_students = getRecentStudents();

include '../includes/header.php';
?>

<div class="container">
    <h1>📊 Dashboard</h1>
    
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>👥 Total Students</h3>
            <p class="stat-number"><?php echo $total_students; ?></p>
        </div>
        <div class="stat-card">
            <h3>📚 Total Courses</h3>
            <p class="stat-number"><?php echo $total_courses; ?></p>
        </div>
        <div class="stat-card">
            <h3>🆕 Recent Additions</h3>
            <p class="stat-number"><?php echo $recent_students->num_rows; ?></p>
        </div>
    </div>
    
    <div style="margin-bottom: 1.5rem;">
        <a href="add-student.php" class="btn btn-success">➕ Add New Student</a>
        <a href="students.php" class="btn btn-primary">👥 View All Students</a>
    </div>
    
    <?php if ($recent_students->num_rows > 0): ?>
        <h2>📋 Recent Students</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Course</th>
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($student = $recent_students->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($student['course']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($student['created_at'])); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No students yet. <a href="add-student.php">Add your first student</a></p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>