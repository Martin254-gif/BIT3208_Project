package com.student;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet("/dashboard")
public class DashboardServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        // Check if user is logged in (session exists and has username)
        HttpSession session = request.getSession(false);
        if (session == null || session.getAttribute("username") == null) {
            // Redirect unauthenticated users to login page
            response.sendRedirect("login.jsp?error=Session expired. Please login again.");
            return;
        }
        
        // Set session attributes for JSP
        request.setAttribute("username", session.getAttribute("username"));
        request.setAttribute("loginTime", session.getAttribute("loginTime"));
        request.setAttribute("sessionId", session.getId());
        
        // Forward to dashboard JSP
        request.getRequestDispatcher("dashboard.jsp").forward(request, response);
    }
}