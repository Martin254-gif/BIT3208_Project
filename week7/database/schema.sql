-- Week 7: User Authentication Database Schema
USE student_system;

-- Users table (extends from previous users table)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'lecturer', 'student') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample users (password: admin123, lecturer123, student123)
INSERT INTO users (fullname, email, password_hash, role) VALUES
('Administrator', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Dr. Smith', 'lecturer@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lecturer'),
('Student User', 'student@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'student');

-- Note: The password_hash above is for 'password123' (for testing only)
-- In production, use password_hash('your_password', PASSWORD_DEFAULT)

-- Update students table to include user_id reference
ALTER TABLE students ADD COLUMN user_id INT;
ALTER TABLE students ADD FOREIGN KEY (user_id) REFERENCES users(id);