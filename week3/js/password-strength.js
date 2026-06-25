// Password Strength Checker
// This file provides real-time feedback on password strength

document.addEventListener('DOMContentLoaded', function() {
    
    const passwordInput = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('strengthText');
    const strengthBar = document.getElementById('strengthBar');
    
    // If the password field exists
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            
            // Update strength text
            strengthText.textContent = 'Strength: ' + strength.label;
            strengthText.style.color = strength.color;
            
            // Update strength bar
            strengthBar.style.width = strength.percentage + '%';
            strengthBar.style.backgroundColor = strength.color;
        });
    }
    
    // Function to check password strength
    function checkPasswordStrength(password) {
        let score = 0;
        let percentage = 0;
        let label = '';
        let color = '';
        
        // Check length
        if (password.length >= 8) {
            score += 1;
        }
        
        // Check for lowercase letters
        if (/[a-z]/.test(password)) {
            score += 1;
        }
        
        // Check for uppercase letters
        if (/[A-Z]/.test(password)) {
            score += 1;
        }
        
        // Check for numbers
        if (/[0-9]/.test(password)) {
            score += 1;
        }
        
        // Check for special characters
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            score += 1;
        }
        
        // Calculate percentage based on score
        percentage = (score / 5) * 100;
        
        // Determine label and color
        if (password.length === 0) {
            label = 'Enter a password';
            color = '#ccc';
        } else if (score <= 1) {
            label = 'Weak';
            color = '#ff4444';
        } else if (score <= 2) {
            label = 'Fair';
            color = '#ff8800';
        } else if (score <= 3) {
            label = 'Good';
            color = '#ffcc00';
        } else if (score <= 4) {
            label = 'Strong';
            color = '#44bb44';
        } else {
            label = 'Very Strong';
            color = '#00aa00';
        }
        
        return {
            score: score,
            percentage: percentage,
            label: label,
            color: color
        };
    }
});