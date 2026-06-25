<?php
// Include the database connection file
include '../db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        /* Styling for the page */
        * { box-sizing: border-box; }
        body { font-family: Arial; padding: 20px; background: #f0f2f5; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; }
        h1 { color: #1a73e8; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #1a73e8; color: white; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        tr:hover { background: #f5f5f5; }
        .btn { display: inline-block; padding: 6px 12px; text-decoration: none; border-radius: 4px; margin: 2px; }
        .btn-add { background: #28a745; color: white; }
        .btn-edit { background: #ffc107; color: black; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-add:hover { background: #218838; }
        .btn-edit:hover { background: #e0a800; }
        .btn-delete:hover { background: #c82333; }
        .empty { text-align: center; padding: 30px; color: #666; }
        .actions { display: flex; gap: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Student List</h1>
        <!-- Button to add new student -->
        <a href="add.php" class="btn btn-add">➕ Add New Student</a>
        
        <!-- Table to display students -->
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
                <?php
                // Get all students from database, newest first
                $sql = "SELECT * FROM students ORDER BY id DESC";
                $result = $conn->query($sql);
                
                // Check if there are any students
                if ($result->num_rows > 0) {
                    // Loop through each student and display in table
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>" . htmlspecialchars($row['student_id']) . "</td>
                            <td>" . htmlspecialchars($row['fullname']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['course']) . "</td>
                            <td class='actions'>
                                <a href='edit.php?id={$row['id']}' class='btn btn-edit'>✏️</a>
                                <a href='delete.php?id={$row['id']}' class='btn btn-delete' onclick='return confirm(\"Delete this student?\")'>🗑️</a>
                            </td>
                        </tr>";
                    }
                } else {
                    // No students found
                    echo "<tr><td colspan='6' class='empty'>No students found. Add one!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>