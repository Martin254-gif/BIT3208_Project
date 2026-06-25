<?php
include '../includes/header.php';
?>

<div class="container" style="max-width: 100%;">
    <h1>📊 Dashboard</h1>

    <div class="stats-grid">
        <div class="stat-card">
            <span class="number">150</span>
            <p>Total Students</p>
        </div>
        <div class="stat-card">
            <span class="number">12</span>
            <p>Total Courses</p>
        </div>
        <div class="stat-card">
            <span class="number">5</span>
            <p>New This Week</p>
        </div>
    </div>

    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 1.5rem;">
        <a href="#" class="btn btn-success">➕ Add Student</a>
        <a href="#" class="btn btn-primary">👥 View Students</a>
    </div>

    <h2>📋 Recent Students</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="Student ID">STU2025001</td>
                    <td data-label="Full Name">John Doe</td>
                    <td data-label="Course">Computer Science</td>
                    <td data-label="Actions" class="actions">
                        <a href="#" class="btn btn-warning btn-sm">✏️</a>
                        <a href="#" class="btn btn-danger btn-sm">🗑️</a>
                    </td>
                </tr>
                <tr>
                    <td data-label="Student ID">STU2025002</td>
                    <td data-label="Full Name">Jane Smith</td>
                    <td data-label="Course">Business Admin</td>
                    <td data-label="Actions" class="actions">
                        <a href="#" class="btn btn-warning btn-sm">✏️</a>
                        <a href="#" class="btn btn-danger btn-sm">🗑️</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>