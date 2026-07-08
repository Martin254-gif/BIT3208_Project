package com.student;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.servlet.http.Cookie;

@WebServlet("/logout")
public class LogoutServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        // Get current session (don't create new one)
        HttpSession session = request.getSession(false);
        if (session != null) {
            // ---------- DESTROY SESSION ----------
            session.invalidate();
            System.out.println("✅ Session destroyed!");
        }
        
        // ---------- REMOVE SESSION COOKIE ----------
        Cookie sessionCookie = new Cookie("JSESSIONID", "");
        sessionCookie.setMaxAge(0);
        response.addCookie(sessionCookie);
        
        // Redirect to login page with success message
        response.sendRedirect("login.jsp?message=Logged out successfully");
    }
}