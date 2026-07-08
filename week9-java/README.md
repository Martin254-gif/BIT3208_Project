# Week 9: Java Servlets, Session Management, and Cookies

## Student Login System

**BIT3208 - Advanced Web Design**  
**Author:** Martin Migwi
**Date:** July 2026

---

## 📋 Table of Contents

1. [Project Overview](#-project-overview)
2. [Learning Objectives](#-learning-objectives)
3. [Technologies Used](#-technologies-used)
4. [Project Structure](#-project-structure)
5. [Servlet Lifecycle](#-servlet-lifecycle)
6. [Session vs Cookies](#-session-vs-cookies)
7. [Features Implemented](#-features-implemented)
8. [Setup Instructions](#-setup-instructions)
9. [Deployment Steps](#-deployment-steps)
10. [Screenshots](#-screenshots)
11. [Common Errors & Solutions](#-common-errors--solutions)
12. [Student Reflection](#-student-reflection)
13. [Author](#-author)

---

## 📖 Project Overview

This project is a **Student Login System** built using Java Servlets and JSP. It demonstrates:

- ✅ Java Web Services and Servlets
- ✅ Servlet Lifecycle (init, service, destroy)
- ✅ Session Management using HttpSession
- ✅ Cookies for "Remember Me" functionality
- ✅ Deployment using Apache Tomcat

### What is a Java Web Service?

A Java Web Service allows web applications to communicate with clients through HTTP requests. A Java Servlet receives requests from browsers, processes them, and returns responses.

**Example Flow:**

Student opens browser
↓
Clicks Login
↓
Servlet receives request
↓
Servlet validates user
↓
Servlet creates session
↓
User accesses dashboard

text

### What is a Servlet?

A Servlet is a Java class that runs on a web server. It receives requests from users, processes data, and returns HTML or other responses.

**Without Servlet:**
Browser → Static HTML Page

text

**With Servlet:**
Browser → Servlet → Session → Browser

text

### Features of Servlets
- ✅ Server-side programming
- ✅ Dynamic content generation
- ✅ Platform independent
- ✅ Fast performance
- ✅ Supports session tracking
- ✅ Secure
- ✅ Reusable

---

## 🎯 Learning Objectives

| # | Objective | Status |
|---|-----------|--------|
| 1 | Explain Java Web Services | ✅ |
| 2 | Describe the Servlet lifecycle | ✅ |
| 3 | Explain session management in Java web applications | ✅ |
| 4 | Differentiate between sessions and cookies | ✅ |
| 5 | Implement session tracking using HttpSession | ✅ |
| 6 | Create and manage cookies in Java Servlets | ✅ |
| 7 | Develop a simple login application that tracks user sessions | ✅ |
| 8 | Deploy and test the application using Apache Tomcat | ✅ |

---

## 🛠️ Technologies Used

| Technology | Version | Purpose |
|------------|---------|---------|
| **Java** | 8+ | Backend logic |
| **Java Servlets** | 4.0 | Request processing |
| **JSP** | 2.3 | Dynamic content |
| **Apache Tomcat** | 9 | Web server and servlet container |
| **HTML5** | - | Page structure |
| **CSS3** | - | Styling |
| **HttpSession** | - | Session management |
| **Cookies** | - | Client-side storage |

---

## 📁 Project Structure
week9-java/
├── src/
│ └── main/
│ ├── java/
│ │ └── com/
│ │ └── student/
│ │ ├── LoginServlet.java # Authentication logic
│ │ ├── DashboardServlet.java # Protected page
│ │ └── LogoutServlet.java # Session destruction
│ ├── webapp/
│ │ ├── WEB-INF/
│ │ │ └── web.xml # Deployment descriptor
│ │ ├── login.jsp # Login page
│ │ ├── dashboard.jsp # Dashboard with session info
│ │ └── error.jsp # Error handling
│ └── resources/
├── screenshots/
│ ├── fig1-tomcat-setup.png
│ ├── fig2-login-page.png
│ ├── fig3-dashboard.png
│ ├── fig4-session-cookie.png
│ ├── fig5-logout.png
│ └── fig6-remember-me.png
├── README.md
└── BIT3208_Project-Java.war

text

---

## 🔄 Servlet Lifecycle

A servlet follows a specific lifecycle managed by Apache Tomcat. There are three main lifecycle methods.

### 1. `init()` – Initialization

**Called only once** when the servlet is first loaded.

**Purpose:** Initialize resources.

**My Code:**
```java
@Override
public void init() throws ServletException {
    System.out.println("✅ LoginServlet initialized!");
}
Real-life Analogy: A school opens once every morning. Teachers prepare classrooms. This preparation happens once.

2. service() – Request Handling
Called every time a client sends a request.

Purpose: Process client requests and generate responses.

My Code (doPost):

java
@Override
protected void doPost(HttpServletRequest request, HttpServletResponse response) {
    String username = request.getParameter("username");
    HttpSession session = request.getSession();
    session.setAttribute("username", username);
    response.sendRedirect("dashboard");
}
Real-life Analogy: Every student entering the office is served individually.

3. destroy() – Cleanup
Called once before the servlet is removed.

Purpose: Release resources, close database connections.

My Code:

java
@Override
public void destroy() {
    System.out.println("❌ LoginServlet destroyed!");
}
Real-life Analogy: School closes. Lights are switched off. Doors locked.

Servlet Lifecycle Diagram
text
Client Request
     |
Load Servlet
     |
init()  ← Called once
     |
service()  ← Called for each request
     |
service()  ← Called for each request
     |
service()  ← Called for each request
     |
destroy()  ← Called once
🔐 Session vs Cookies
HTTP is Stateless
HTTP is a stateless protocol – every request is independent. Without session tracking:

text
Login → Dashboard → Server forgets user → Login Again
This is why session management is necessary.

What is Session Management?
A session stores user information while they interact with a website.

My Implementation Flow:

text
User logs in
     ↓
Server creates HttpSession
     ↓
Session ID generated
     ↓
User continues browsing (Dashboard)
     ↓
Logout
     ↓
Session destroyed
Advantages of Session Management
✅ Maintains login state across pages

✅ Stores user information (username, login time)

✅ Improves user experience (stays logged in)

✅ Increases security (session ID validation)

✅ Personalizes the dashboard

🍪 Sessions vs Cookies Comparison
Feature	Session (HttpSession)	Cookies
Storage Location	Server-side	Client-side (browser)
Security	More secure	Less secure
Storage Capacity	Large	Small (4KB)
Who Manages?	Server manages	Browser manages
Recommended for	Login, authentication	Preferences, Remember Me
My Use	User login state	"Remember Me" username
Using HttpSession
Create Session:

java
HttpSession session = request.getSession();
Store Data:

java
session.setAttribute("username", username);
session.setAttribute("loginTime", new java.util.Date().toString());
Retrieve Data:

java
String username = (String) session.getAttribute("username");
String loginTime = (String) session.getAttribute("loginTime");
Destroy Session:

java
session.invalidate();
Using Cookies
Creating a Cookie:

java
Cookie rememberCookie = new Cookie("rememberedUser", username);
rememberCookie.setMaxAge(30 * 24 * 60 * 60); // 30 days
response.addCookie(rememberCookie);
Reading Cookies:

java
Cookie[] cookies = request.getCookies();
for (Cookie cookie : cookies) {
    if ("rememberedUser".equals(cookie.getName())) {
        rememberedUser = cookie.getValue();
    }
}
Deleting Cookies:

java
Cookie removeCookie = new Cookie("rememberedUser", "");
removeCookie.setMaxAge(0);
response.addCookie(removeCookie);
✨ Features Implemented
Class Exercise 1 – Login System
Requirement	Status
Login page (login.jsp) with username and password	✅
Validate username is not empty	✅
HttpSession created after successful login	✅
Welcome page showing logged-in username	✅
Logout button invalidates session	✅
Redirect to login page after logout	✅
Class Exercise 2 – Session Tracking & Cookies
Requirement	Status
Username stored using HttpSession	✅
Session ID displayed on dashboard	✅
Login time displayed on dashboard	✅
Session creation time displayed	✅
Last accessed time displayed	✅
Unauthenticated users redirected to login	✅
Assignment – Remember Me
Requirement	Status
"Remember Me" feature using cookies	✅
Cookie stores username for 30 days	✅
Auto-fill username on revisit	✅
Cookie removed when unchecked	✅
🚀 Setup Instructions
Prerequisites
Software	Version	Download Link
JDK	8+	Adoptium
Apache Tomcat	9	Tomcat 9
VS Code	Latest	VS Code
Deployment Steps
Step 1: Package the application

bash
cd /Applications/XAMPP/xamppfiles/htdocs/BIT3208_Project-Java
jar -cvf BIT3208_Project-Java.war -C src/main/webapp .
Step 2: Deploy to Tomcat

bash
cp BIT3208_Project-Java.war /Applications/tomcat/webapps/
Step 3: Start Tomcat

bash
/Applications/tomcat/bin/startup.sh
Step 4: Access the application

text
http://localhost:8080/BIT3208_Project-Java/login.jsp
Step 5: Test Login

Field	Value
Username	student
Password	Any password
Step 6: Stop Tomcat (when done)

bash
/Applications/tomcat/bin/shutdown.sh
📸 Screenshots
Fig 1: Apache Tomcat Setup
https://screenshots/fig1-tomcat-setup.png

Figure 1: Apache Tomcat 9 successfully running on localhost. The Tomcat welcome page confirms the server is operational.

Fig 2: Login Page
https://screenshots/fig2-login-page.png

Figure 2: Student Login page with username and password fields, "Remember Me" checkbox, and demo credentials.

Fig 3: Dashboard with Session Information
https://screenshots/fig3-dashboard.png

Figure 3: Dashboard displaying session information including username, Session ID, login time, and session creation time.

Fig 4: Session Cookies in Browser DevTools
https://screenshots/fig4-session-cookie.png

Figure 4: Browser Developer Tools showing cookies stored after login. JSESSIONID tracks the session, and rememberedUser stores the username.

Fig 5: Logout Functionality
https://screenshots/fig5-logout.png

Figure 5: Logout confirmation showing "Logged out successfully" message. Session was destroyed using session.invalidate().

Fig 6: Remember Me Auto-Fill
https://screenshots/fig6-remember-me.png

Figure 6: "Remember Me" feature auto-filling the username after browser restart. The username is stored in a cookie for 30 days.

⚠️ Common Errors & Solutions
Error	Cause	Solution
404 Not Found	Wrong servlet URL	Check @WebServlet("/login") mapping
500 Internal Error	Java exception	Check Tomcat logs
Session becomes null	Session expired	Create new session or redirect to login
Cookie not found	Browser blocks cookies	Enable cookies or use HttpSession
Tomcat not starting	Port conflict	Change port in server.xml or stop conflicting app
📝 Student Reflection
During Week 9, I learned about Java Web Services and servlet-based web development. I successfully developed a Student Login System using Java Servlets and JSP with session management and cookies.

What I Learned:
1. Servlet Lifecycle:

init(): Called once when servlet is loaded (like setting up resources)

service(): Called for every request (doGet/doPost handles specific HTTP methods)

destroy(): Called when servlet is removed (clean up resources)

2. Session Management with HttpSession:

HttpSession stores user data on the server

Sessions maintain login state across multiple requests

session.getAttribute() and session.setAttribute() store/retrieve data

session.invalidate() destroys the session on logout

3. Cookies vs Sessions:

Sessions are stored on the server (more secure, larger storage)

Cookies are stored in the browser (less secure, smaller storage)

Cookies are useful for preferences like "Remember Me"

Sessions are recommended for authentication

4. Remember Me Feature:

Implemented using cookies with 30-day expiry

When checked, username stored in browser

On revisit, cookie auto-fills username

Unchecking deletes the cookie

Challenges Faced:
Configuring Apache Tomcat in VS Code was challenging

Understanding the deployment process (WAR files)

Compiling Java servlets correctly

Solutions:
Used manual deployment with jar command

Verified deployment with ls commands

Compiled using javac with servlet-api classpath

🏗️ Real-Life Applications
The concepts learned in Week 9 apply to:

✅ Student Portals (like the one I built)

✅ Online Banking (session management for security)

✅ Hospital Management Systems

✅ E-Commerce Websites (shopping cart)

✅ Hotel Booking Systems

✅ Airline Reservation Systems

✅ Library Management Systems

✅ Government e-Services

📊 Best Practices
✅ Use HttpSession for authentication and sensitive data

✅ Store only essential information in the session

✅ Invalidate sessions immediately after user logout

✅ Avoid storing passwords in cookies

✅ Use HTTPS for secure communication

✅ Set appropriate session timeout values

✅ Handle session expiration gracefully by redirecting users to the login page

👨‍💻 Author
Martin Mwangi

GitHub: @Martin254-gif

Course: BIT3208 - Advanced Web Design

📄 License
This project is for educational purposes as part of the BIT3208 course.

🙏 Acknowledgments
BIT3208 Course Instructors - For guidance and course structure

Apache Tomcat Team - For Java web server

Java Community - For documentation and support

🎉 Summary
In this lesson, I have learned that:

Java Servlets process HTTP requests and responses

The servlet lifecycle consists of init(), service(), and destroy() methods

Because HTTP is stateless, Java provides session management mechanisms

HttpSession is the preferred approach for maintaining user login information

Cookies store small amounts of data in the user's browser and are useful for remembering preferences

Apache Tomcat manages servlet execution and deployment for Java web applications
