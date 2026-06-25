-- Student Management System Database Schema

-- Create database
CREATE DATABASE IF NOT EXISTS student_system;
USE student_system;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) UNIQUE NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    course VARCHAR(100),
    enrollment_date DATE,
    status ENUM('active', 'inactive', 'graduated') DEFAULT 'active',
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

-- Insert default admin user
INSERT INTO users (fullname, email, password_hash, role) 
VALUES ('Administrator', 'admin@example.com', '$2y$10$8kqY6nX7JZxY9wLmNpQrTuVwXyZ1234567890', 'admin');

-- Insert sample students
INSERT INTO students (student_id, fullname, email, phone, course, enrollment_date, status) VALUES
('STU001', 'John Doe', 'john.doe@example.com', '0712345678', 'Computer Science', '2025-01-15', 'active'),
('STU002', 'Jane Smith', 'jane.smith@example.com', '0723456789', 'Business Administration', '2025-01-20', 'active'),
('STU003', 'Bob Johnson', 'bob.johnson@example.com', '0734567890', 'Engineering', '2025-02-01', 'active');

-- Insert sample courses
INSERT INTO courses (course_code, course_name, description, credits) VALUES
('CS101', 'Introduction to Programming', 'Learn the fundamentals of programming', 3),
('CS201', 'Data Structures', 'Understanding data structures and algorithms', 4),
('BUS101', 'Business Management', 'Introduction to business management principles', 3),
('ENG101', 'Engineering Mathematics', 'Mathematics for engineering students', 4);