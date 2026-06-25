-- Week 6 Database Schema
CREATE DATABASE IF NOT EXISTS student_system;
USE student_system;

-- Students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) UNIQUE NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    course VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Courses table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(20) UNIQUE NOT NULL,
    course_name VARCHAR(100) NOT NULL,
    description TEXT,
    credits INT DEFAULT 3,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data
INSERT INTO courses (course_code, course_name, description) VALUES
('CS101', 'Computer Science', 'Introduction to programming'),
('BUS101', 'Business Administration', 'Business management basics'),
('ENG101', 'Engineering', 'Engineering fundamentals');

INSERT INTO students (student_id, fullname, email, course) VALUES
('STU2025001', 'John Doe', 'john@example.com', 'Computer Science'),
('STU2025002', 'Jane Smith', 'jane@example.com', 'Business Administration');