// Form Validation
document.addEventListener('DOMContentLoaded', function() {
    // Get all forms
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validate all inputs in the form
            const inputs = this.querySelectorAll('input[required], textarea[required]');
            
            inputs.forEach(input => {
                // Remove previous error states
                input.style.borderColor = '';
                const errorMsg = input.parentElement.querySelector('.error-msg');
                if (errorMsg) errorMsg.remove();
                
                // Check if empty
                if (input.value.trim() === '') {
                    isValid = false;
                    input.style.borderColor = 'red';
                    showError(input, 'This field is required');
                }
                
                // Email validation
                if (input.type === 'email' && input.value.trim() !== '') {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(input.value.trim())) {
                        isValid = false;
                        input.style.borderColor = 'red';
                        showError(input, 'Please enter a valid email address');
                    }
                }
                
                // Password validation (min 6 characters)
                if (input.type === 'password' && input.value.trim() !== '') {
                    if (input.value.trim().length < 6) {
                        isValid = false;
                        input.style.borderColor = 'red';
                        showError(input, 'Password must be at least 6 characters');
                    }
                }
            });
            
            // Password confirmation
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm_password');
            if (password && confirmPassword) {
                if (password.value !== confirmPassword.value) {
                    isValid = false;
                    confirmPassword.style.borderColor = 'red';
                    showError(confirmPassword, 'Passwords do not match');
                }
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
    
    // Function to show error message
    function showError(input, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-msg';
        errorDiv.style.color = 'red';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.style.marginTop = '0.25rem';
        errorDiv.textContent = '❌ ' + message;
        input.parentElement.appendChild(errorDiv);
    }
});

// Password strength checker (bonus)
function checkPasswordStrength(password) {
    let score = 0;
    if (password.length >= 8) score++;
    if (/[a-z]/.test(password)) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) score++;
    return score;
}