<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: linear-gradient(135deg, #1a73e8, #0d47a1); display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.3); width: 100%; max-width: 400px; }
        h1 { text-align: center; color: #1a73e8; margin-bottom: 10px; }
        .subtitle { text-align: center; color: #666; margin-bottom: 25px; font-size: 14px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-weight: 600; margin-bottom: 5px; font-size: 14px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px 14px; border: 2px solid #e0e0e0; border-radius: 6px; font-size: 15px; }
        input:focus { outline: none; border-color: #1a73e8; }
        .checkbox-group { display: flex; align-items: center; gap: 8px; margin-bottom: 18px; }
        .checkbox-group input { width: 18px; height: 18px; cursor: pointer; }
        .checkbox-group label { margin: 0; font-weight: normal; cursor: pointer; }
        button { width: 100%; padding: 12px; background: #1a73e8; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.3s; }
        button:hover { background: #1557b0; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 6px; margin-bottom: 15px; border: 1px solid #f5c6cb; text-align: center; }
        .message { background: #d4edda; color: #155724; padding: 10px; border-radius: 6px; margin-bottom: 15px; border: 1px solid #c3e6cb; text-align: center; }
        .demo { margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 6px; text-align: center; font-size: 13px; border: 1px solid #e0e0e0; }
        .demo strong { color: #1a73e8; }
        .demo p { margin: 3px 0; }
        .hint { font-size: 11px; color: #888; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎓 Student Login</h1>
        <p class="subtitle">Sign in to access your dashboard</p>
        
        <%
            String error = request.getParameter("error");
            if (error != null && !error.isEmpty()) {
        %>
            <div class="error">❌ <%= error %></div>
        <%
            }
            String message = request.getParameter("message");
            if (message != null && !message.isEmpty()) {
        %>
            <div class="message">✅ <%= message %></div>
        <%
            }
        %>
        
        <form action="login" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="rememberMe" name="rememberMe">
                <label for="rememberMe">Remember Me</label>
            </div>
            <button type="submit">Sign In</button>
        </form>
        
        <div class="demo">
            <strong>📝 Demo Credentials</strong>
            <p><strong>Username:</strong> student</p>
            <p><strong>Password:</strong> (any password works)</p>
            <p class="hint">💡 Try "Remember Me" to save your username!</p>
        </div>
    </div>
</body>
</html>