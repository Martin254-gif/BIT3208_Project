<?php
session_start();
include '../includes/db-connect.php';
include '../includes/functions.php';

$page_title = 'All Students';
$search = $_GET['search'] ?? '';
$students = getStudents($search);

include '../includes/header.php';
?>

<div class="container">
    <h1>👥 All Students</h1>
    
    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; flex-wrap: wrap; gap: 1rem;">
        <a href="add-student.php" class="btn btn-success">➕ Add New Student</a>
        
        <form method="get" class="search-bar" style="flex: 1; max-width: 400px; display: flex; gap: 0.5rem;">
            <input type="text" name="search" placeholder="Search by name or ID..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary">🔍 Search</button>
            <?php if ($search): ?>
                <a href="students.php" class="btn btn-warning">Clear</a>
            <?php endif; ?>
        </form>
    </div>
    
    <?php if ($students->num_rows > 0): ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($student = $students->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>
                            <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($student['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['course']); ?></td>
                            <td class="actions">
                                <a href="edit-student.php?id=<?php echo $student['id']; ?>" class="btn btn-warning btn-sm">✏️</a>
                                <a href="delete-student.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this student?')">🗑️</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <p><strong>Total:</strong> <?php echo $students->num_rows; ?> students found.</p>
    <?php else: ?>
        <div class="alert alert-error">
            <?php if ($search): ?>
                No students found matching "<strong><?php echo htmlspecialchars($search); ?></strong>".
                <a href="students.php">View all students</a>
            <?php else: ?>
                No students found. <a href="add-student.php">Add your first student</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>