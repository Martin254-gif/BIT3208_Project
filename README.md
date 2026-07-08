# 🎓 Student Management System

## Full Stack Web Development Project

**BIT3208 - Advanced Web Design**  
**Author:** Martin Migwi  
**Date:** July 2026

---

## 📋 Table of Contents

1. [Project Overview](#-project-overview)
2. [Technologies Used](#-technologies-used)
3. [Project Structure](#-project-structure)
4. [Weekly Progress](#-weekly-progress)
5. [Setup Instructions](#-setup-instructions)
6. [Screenshots](#-screenshots)
7. [Author](#-author)
8. [License](#-license)

---

## 📖 Project Overview

This repository contains the complete **Student Management System** project developed over 9 weeks as part of the BIT3208 Advanced Web Design course.

The project started as a PHP-based web application (Weeks 1-8) and transitioned to Java web development (Week 9) to demonstrate both server-side technologies.

### What the System Does

- ✅ Manages student records (Add, View, Edit, Delete)
- ✅ Handles user authentication (Login, Register, Logout)
- ✅ Maintains user sessions
- ✅ Tracks user login information
- ✅ Provides role-based access control
- ✅ Responds to different screen sizes (responsive design)
- ✅ Uses cookies for "Remember Me" functionality

---

## 🛠️ Technologies Used

### Weeks 1-8 (PHP Stack)
| Technology | Version | Purpose |
|------------|---------|---------|
| **PHP** | 7.4+ | Backend logic |
| **MySQL** | 5.7+ | Database storage |
| **HTML5** | - | Page structure |
| **CSS3** | - | Styling |
| **JavaScript** | ES6 | Form validation, interactivity |
| **XAMPP** | - | Local development server |

### Week 9 (Java Stack)
| Technology | Version | Purpose |
|------------|---------|---------|
| **Java** | 8+ | Backend logic |
| **Java Servlets** | 4.0 | Request processing |
| **JSP** | 2.3 | Dynamic content |
| **Apache Tomcat** | 9 | Web server |
| **Cookies** | - | Session management |
| **HttpSession** | - | User tracking |

---

## 📁 Project Structure
BIT3208_Project/
│
├── week1/ # Local Environment Setup
│ ├── index.php # Hello World
│ ├── db-test.php # Database connection test
│ └── screenshots/
│
├── week2/ # Wireframes & UI Design
│ ├── wireframes/ # Login, Dashboard, Mobile mockups
│ ├── project-proposal-summary.md
│ └── folder-structure-planning.md
│
├── week3/ # Frontend & Backend Foundations
│ ├── js/ # Form validation, Password strength
│ ├── php/ # PHP syntax practice
│ └── db/ # Database connection
│
├── week4/ # Dynamic Backend Processing
│ ├── pages/ # Login, Register, Dashboard, Contact
│ └── includes/ # Header, Footer, Functions
│
├── week5/ # Database & CRUD Operations
│ ├── pages/ # Add, Edit, Delete, View students
│ └── includes/ # Reusable PHP components
│
├── week6/ # Database Integration
│ ├── pages/ # Enhanced CRUD with search
│ └── includes/ # Functions and helpers
│
├── week7/ # User Authentication & Sessions
│ ├── pages/ # Login, Register, Dashboard, Profile
│ └── includes/ # Auth middleware, Functions
│
├── week8/ # Responsive Web Design
│ ├── task1-profile/ # Personal Profile Page
│ ├── task2-products/ # Product Showcase
│ └── school-system/ # Responsive School System
│
├── week9-java/ # Java Servlets & Session Management
│ ├── src/
│ │ └── main/
│ │ ├── java/com/student/
│ │ │ ├── LoginServlet.java
│ │ │ ├── DashboardServlet.java
│ │ │ └── LogoutServlet.java
│ │ └── webapp/
│ │ ├── WEB-INF/web.xml
│ │ ├── login.jsp
│ │ ├── dashboard.jsp
│ │ └── error.jsp
│ ├── screenshots/
│ │ ├── fig1-tomcat-setup.png
│ │ ├── fig2-login-page.png
│ │ ├── fig3-dashboard.png
│ │ ├── fig4-session-cookie.png
│ │ ├── fig5-logout.png
│ │ └── fig6-remember-me.png
│ └── README.md
│
├── README.md # This file
├── .gitignore # Git ignore file
└── Reporting logbook.pdf # Project documentation

text

---

## 🗓️ Weekly Progress

| Week | Topic | Key Deliverables | Status |
|------|-------|------------------|--------|
| **Week 1** | Local Environment Setup | XAMPP, Hello page, DB connection | ✅ Complete |
| **Week 2** | Wireframes & UI Design | Login, Dashboard, Mobile mockups | ✅ Complete |
| **Week 3** | Frontend & Backend Foundations | JS validation, PHP practice, DB connection | ✅ Complete |
| **Week 4** | Dynamic Backend Processing | Login, Register, Contact forms | ✅ Complete |
| **Week 5** | Database & CRUD Operations | Add, Edit, Delete, View students | ✅ Complete |
| **Week 6** | Database Integration | Dashboard with stats, Search | ✅ Complete |
| **Week 7** | User Authentication | Registration, Login, Sessions, Roles | ✅ Complete |
| **Week 8** | Responsive Web Design | Profile page, Products, Responsive system | ✅ Complete |
| **Week 9** | Java Servlets & Session Management | Login system, HttpSession, Cookies, Tomcat | ✅ Complete |

---

## 🚀 Setup Instructions

### For Weeks 1-8 (PHP Application)

#### Prerequisites
- XAMPP (or MAMP/WAMP)
- PHP 7.4+
- MySQL 5.7+

#### Steps

1. **Clone the repository:**
```bash
git clone https://github.com/Martin254-gif/BIT3208_Project.git
Move to XAMPP htdocs:

bash
# Mac
cp -r BIT3208_Project /Applications/XAMPP/xamppfiles/htdocs/

# Windows
copy BIT3208_Project C:\xampp\htdocs\
Create database:

Open http://localhost/phpmyadmin

Create database: student_system

Import week7/database/schema.sql

Configure database:

Edit week7/includes/db-connect.php

Update credentials

Access the application:

text
http://localhost/student-management-system/week7/pages/index.php
For Week 9 (Java Application)
Prerequisites
JDK 8+

Apache Tomcat 9

VS Code with Java extensions

Steps
Navigate to Week 9 folder:

bash
cd week9-java
Package the WAR file:

bash
jar -cvf BIT3208_Project-Java.war -C src/main/webapp .
Deploy to Tomcat:

bash
cp BIT3208_Project-Java.war /Applications/tomcat/webapps/
Start Tomcat:

bash
/Applications/tomcat/bin/startup.sh
Access the application:

text
http://localhost:8080/BIT3208_Project-Java/login.jsp
🔐 Default Login Credentials
PHP Application (Weeks 1-8)
Role	Email	Password
Administrator	admin@example.com	password123
Lecturer	lecturer@example.com	password123
Student	student@example.com	password123
Java Application (Week 9)
Field	Value
Username	student
Password	Any password
📸 Screenshots
Week 8: Responsive Design
Desktop View
https://week8/screenshots/fig7-system-desktop.png

Tablet View
https://week8/screenshots/fig8-system-tablet.png

Mobile View
https://week8/screenshots/fig9-system-mobile.png

Week 9: Java Servlets & Session Management
Fig 1: Apache Tomcat Setup
https://week9-java/screenshots/fig1-tomcat-setup.png
Apache Tomcat 9 running successfully on localhost

Fig 2: Login Page
https://week9-java/screenshots/fig2-login-page.png
Student Login page with username, password, and Remember Me

Fig 3: Dashboard with Session Information
https://week9-java/screenshots/fig3-dashboard.png
Dashboard showing username, session ID, and login time

Fig 4: Session Cookies in DevTools
https://week9-java/screenshots/fig4-session-cookie.png
JSESSIONID and rememberedUser cookies in browser

Fig 5: Logout Functionality
https://week9-java/screenshots/fig5-logout.png
Logout confirmation message after session destruction

Fig 6: Remember Me Auto-Fill
https://week9-java/screenshots/fig6-remember-me.png
Username auto-filled from cookie after browser restart

📚 Key Features Learned
   PHP Application (Weeks 1-8)
Feature	Description
CRUD Operations	Create, Read, Update, Delete students
User Authentication	Login, Register, Logout with password hashing
Session Management	Track logged-in users with PHP sessions
Role-Based Access	Admin, Lecturer, Student roles
Search Functionality	Find students by name or ID
Responsive Design	Mobile-first, works on all devices
    Java Application (Week 9)
Feature	Description
Servlet Lifecycle	init(), service(), destroy()
HttpSession	Server-side user tracking
Cookies	Client-side storage for preferences
Remember Me	Cookie-based auto-fill
JSP Pages	Dynamic content generation
Tomcat Deployment	WAR file deployment
🎓 Learning Outcomes
By completing this project, I have learned:

Weeks 1-8 (PHP)
✅ Setting up a local development environment

✅ Designing wireframes and UI mockups

✅ Building responsive web pages

✅ Creating and connecting to databases

✅ Performing CRUD operations

✅ Implementing user authentication

✅ Managing sessions

✅ Applying security best practices

Week 9 (Java)
✅ Java Web Services and Servlets

✅ Servlet lifecycle (init, service, destroy)

✅ Session management with HttpSession

✅ Cookies for user preferences

✅ Login application with session tracking

✅ Deployment with Apache Tomcat

🛠️ Common Issues & Solutions
Issue	Solution
404 Not Found	Check URL path and servlet mapping
500 Internal Error	Check Tomcat logs for Java exceptions
Session expired	Implement redirect to login page
Tomcat not starting	Check port conflicts (8080)
Database connection failed	Verify credentials in db-connect.php
👨‍💻 Author
Martin Migwi

GitHub: @Martin254-gif

Project: BIT3208_Project

Course: BIT3208 - Advanced Web Design

📄 License
This project is for educational purposes as part of the BIT3208 course.

🙏 Acknowledgments
BIT3208 Course Instructors - For guidance and course structure

XAMPP Team - For local development environment

Apache Tomcat Team - For Java web server

PHP & Java Communities - For documentation and support

📊 Project Statistics
Metric	Value
Total Weeks	9
PHP Files	20+
Java Files	3
JSP Pages	3
Screenshots	30+
Database Tables	3
Features Implemented	15+
🏆 Final Conclusion
This 9-week project has been a comprehensive journey through full-stack web development. Starting with PHP and MySQL, I built a complete Student Management System with user authentication, CRUD operations, and responsive design. In Week 9, I transitioned to Java web development, building a Student Login System with Servlets, JSP, session management, and cookies.

Key Takeaways:

Both PHP and Java are powerful server-side technologies

Session management is essential for maintaining user state

HTTP is stateless, requiring sessions or cookies

Proper project structure improves maintainability

Responsive design ensures accessibility on all devices

© 2026 Martin Mwangi | BIT3208 - Advanced Web Design

🎉 Thank you for visiting this project!
