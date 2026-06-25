<?php
// Helper Functions

// Sanitize input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Get total students
function getTotalStudents() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as count FROM students");
    return $result->fetch_assoc()['count'];
}

// Get total courses
function getTotalCourses() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) as count FROM courses");
    return $result->fetch_assoc()['count'];
}

// Get recent students (last 5)
function getRecentStudents() {
    global $conn;
    return $conn->query("SELECT * FROM students ORDER BY id DESC LIMIT 5");
}

// Get all students with search
function getStudents($search = '') {
    global $conn;
    if (!empty($search)) {
        $search = "%$search%";
        $stmt = $conn->prepare("SELECT * FROM students WHERE fullname LIKE ? OR student_id LIKE ? OR email LIKE ? ORDER BY id DESC");
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();
        return $stmt->get_result();
    } else {
        return $conn->query("SELECT * FROM students ORDER BY id DESC");
    }
}

// Get student by ID
function getStudentById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Add student
function addStudent($data) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO students (student_id, fullname, email, phone, course) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $data['student_id'], $data['fullname'], $data['email'], $data['phone'], $data['course']);
    return $stmt->execute();
}

// Update student
function updateStudent($id, $data) {
    global $conn;
    $stmt = $conn->prepare("UPDATE students SET fullname=?, email=?, phone=?, course=? WHERE id=?");
    $stmt->bind_param("ssssi", $data['fullname'], $data['email'], $data['phone'], $data['course'], $id);
    return $stmt->execute();
}

// Delete student
function deleteStudent($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Generate student ID
function generateStudentId() {
    $year = date('Y');
    global $conn;
    $result = $conn->query("SELECT MAX(CAST(SUBSTRING(student_id, 8) AS UNSIGNED)) as last_id FROM students");
    $row = $result->fetch_assoc();
    $next = ($row['last_id'] ?? 0) + 1;
    return 'STU' . $year . str_pad($next, 4, '0', STR_PAD_LEFT);
}

// Get courses for dropdown
function getCourses() {
    global $conn;
    $result = $conn->query("SELECT course_name FROM courses ORDER BY course_name");
    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row['course_name'];
    }
    return $courses;
}
?>