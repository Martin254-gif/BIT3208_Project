<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #f8f9fa; margin: 0; }
        .container { background: white; padding: 50px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); text-align: center; max-width: 500px; }
        .icon { font-size: 60px; margin-bottom: 10px; }
        h1 { color: #dc3545; margin: 10px 0; }
        p { color: #666; line-height: 1.6; }
        .btn { display: inline-block; padding: 12px 30px; background: #1a73e8; color: white; text-decoration: none; border-radius: 6px; margin-top: 20px; }
        .btn:hover { background: #1557b0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">⚠️</div>
        <h1>Something Went Wrong</h1>
        <p>We're sorry, but an error occurred while processing your request.</p>
        <p style="font-size: 14px; color: #999;">
            <%= request.getParameter("message") != null ? request.getParameter("message") : "Please try again later." %>
        </p>
        <a href="login.jsp" class="btn">🔙 Return to Login</a>
    </div>
</body>
</html>