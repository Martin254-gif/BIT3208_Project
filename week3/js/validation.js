// JavaScript Form Validation
// This file validates a login form with username and password fields

document.addEventListener('DOMContentLoaded', function() {
    
    // Get the form element
    const loginForm = document.getElementById('loginForm');
    
    // If form exists, add submit event listener
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            // Prevent form from submitting automatically
            event.preventDefault();
            
            // Get form values
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();
            
            // Validation flags
            let isValid = true;
            
            // Clear previous error messages
            clearErrors();
            
            // Validate Username (minimum 3 characters)
            if (username.length < 3) {
                showError('username', 'Username must be at least 3 characters long');
                isValid = false;
            }
            
            // Validate Password (minimum 6 characters)
            if (password.length < 6) {
                showError('password', 'Password must be at least 6 characters long');
                isValid = false;
            }
            
            // If all validations pass
            if (isValid) {
                alert('✅ Login successful!');
                // In a real application, you would submit the form here
                // loginForm.submit();
            } else {
                alert('❌ Please fix the errors above');
            }
        });
    }
    
    // Function to show error message
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.color = 'red';
        errorDiv.style.fontSize = '14px';
        errorDiv.style.marginTop = '5px';
        errorDiv.textContent = '❌ ' + message;
        
        // Insert error message after the field
        field.parentNode.insertBefore(errorDiv, field.nextSibling);
        
        // Add red border to the field
        field.style.border = '2px solid red';
    }
    
    // Function to clear all error messages
    function clearErrors() {
        // Remove all error messages
        document.querySelectorAll('.error-message').forEach(function(el) {
            el.remove();
        });
        
        // Remove red borders from all fields
        document.querySelectorAll('input').forEach(function(el) {
            el.style.border = '';
        });
    }
});

// Email Validation Function (Bonus)
function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

// Example usage:
// const email = "test@example.com";
// if (validateEmail(email)) {
//     console.log("Valid email");
// } else {
//     console.log("Invalid email");
// }