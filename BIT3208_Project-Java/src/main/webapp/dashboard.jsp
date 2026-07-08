<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.util.Date" %>
<%
    // Check if user is logged in
    String username = (String) session.getAttribute("username");
    String loginTime = (String) session.getAttribute("loginTime");
    String sessionId = session.getId();
    
    if (username == null) {
        response.sendRedirect("login.jsp?error=Please login first");
        return;
    }
%>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; min-height: 100vh; }
        .header { background: #1a73e8; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header h1 { font-size: 22px; }
        .header .user-info { display: flex; align-items: center; gap: 20px; }
        .header .user-info span { font-weight: 600; }
        .logout-btn { background: #dc3545; color: white; padding: 8px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; text-decoration: none; }
        .logout-btn:hover { background: #c82333; }
        .container { max-width: 900px; margin: 30px auto; padding: 0 20px; }
        .welcome-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.1); margin-bottom: 25px; }
        .welcome-card h2 { color: #1a73e8; margin-bottom: 10px; }
        .session-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 15px; border-left: 4px solid #1a73e8; }
        .session-info p { padding: 5px 0; font-size: 14px; }
        .session-info strong { display: inline-block; width: 120px; }
        .session-info code { background: #e9ecef; padding: 2px 8px; border-radius: 4px; font-size: 13px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px; }
        .stat-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; }
        .stat-card .number { font-size: 28px; font-weight: bold; color: #1a73e8; display: block; }
        .stat-card p { color: #666; font-size: 14px; margin-top: 5px; }
        .actions { display: flex; gap: 15px; flex-wrap: wrap; margin-top: 20px; }
        .btn { padding: 10px 25px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; }
        .btn-primary { background: #28a745; color: white; }
        .btn-primary:hover { background: #218838; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-secondary:hover { background: #5a6268; }
        .footer { text-align: center; padding: 20px; color: #888; font-size: 13px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎓 Student Dashboard</h1>
        <div class="user-info">
            <span>👤 <%= username %></span>
            <a href="logout" class="logout-btn">🚪 Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="welcome-card">
            <h2>👋 Welcome, <%= username %>!</h2>
            <p>You have successfully logged into the Student Management System.</p>
            <div class="session-info">
                <h3>📋 Session Information</h3>
                <p><strong>Session ID:</strong> <code><%= sessionId %></code></p>
                <p><strong>Login Time:</strong> <%= loginTime %></p>
                <p><strong>Session Created:</strong> <%= new Date(session.getCreationTime()).toString() %></p>
                <p><strong>Session Last Accessed:</strong> <%= new Date(session.getLastAccessedTime()).toString() %></p>
            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-card"><span class="number">150</span><p>📚 Total Students</p></div>
            <div class="stat-card"><span class="number">12</span><p>📖 Total Courses</p></div>
            <div class="stat-card"><span class="number">5</span><p>📝 New This Week</p></div>
            <div class="stat-card"><span class="number">3</span><p>👨‍🏫 Lecturers</p></div>
        </div>
        <div class="actions">
            <a href="#" class="btn btn-primary">👥 Manage Students</a>
            <a href="#" class="btn btn-secondary">📊 Reports</a>
            <a href="#" class="btn btn-secondary">⚙️ Settings</a>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2026 Student Management System | Built with Java Servlets &amp; JSP</p>
    </div>
</body>
</html>