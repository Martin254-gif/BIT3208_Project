package com.student;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.servlet.http.Cookie;

@WebServlet("/login")
public class LoginServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    // ========== SERVLET LIFECYCLE METHOD 1: init() ==========
    // Called ONCE when servlet is first loaded
    @Override
    public void init() throws ServletException {
        System.out.println("✅ LoginServlet initialized!");
    }

    // ========== SERVLET LIFECYCLE METHOD 2: service() ==========
    // Called for EVERY request (doGet or doPost)
    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        // Get form data
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        String rememberMe = request.getParameter("rememberMe");
        
        // Validate username is not empty
        if (username != null && !username.trim().isEmpty()) {
            
            // ---------- CREATE SESSION ----------
            HttpSession session = request.getSession();
            session.setAttribute("username", username);
            session.setAttribute("loginTime", new java.util.Date().toString());
            
            // ---------- CREATE SESSION COOKIE ----------
            Cookie sessionCookie = new Cookie("JSESSIONID", session.getId());
            sessionCookie.setMaxAge(30 * 60); // 30 minutes
            response.addCookie(sessionCookie);
            
            // ---------- REMEMBER ME COOKIE ----------
            if ("on".equals(rememberMe)) {
                Cookie rememberCookie = new Cookie("rememberedUser", username);
                rememberCookie.setMaxAge(30 * 24 * 60 * 60); // 30 days
                response.addCookie(rememberCookie);
            } else {
                // Remove remember me cookie if exists
                Cookie removeCookie = new Cookie("rememberedUser", "");
                removeCookie.setMaxAge(0);
                response.addCookie(removeCookie);
            }
            
            // Redirect to dashboard
            response.sendRedirect("dashboard");
            
        } else {
            // Invalid login
            response.sendRedirect("login.jsp?error=Please enter username");
        }
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        // Check if already logged in
        HttpSession session = request.getSession(false);
        if (session != null && session.getAttribute("username") != null) {
            response.sendRedirect("dashboard");
            return;
        }
        
        // Check for "Remember Me" cookie
        Cookie[] cookies = request.getCookies();
        String rememberedUser = null;
        if (cookies != null) {
            for (Cookie cookie : cookies) {
                if ("rememberedUser".equals(cookie.getName())) {
                    rememberedUser = cookie.getValue();
                    break;
                }
            }
        }
        
        // Auto-login with remembered user
        if (rememberedUser != null) {
            HttpSession newSession = request.getSession();
            newSession.setAttribute("username", rememberedUser);
            newSession.setAttribute("loginTime", new java.util.Date().toString());
            response.sendRedirect("dashboard");
        } else {
            request.getRequestDispatcher("login.jsp").forward(request, response);
        }
    }

    // ========== SERVLET LIFECYCLE METHOD 3: destroy() ==========
    // Called ONCE when servlet is removed
    @Override
    public void destroy() {
        System.out.println("❌ LoginServlet destroyed!");
    }
}