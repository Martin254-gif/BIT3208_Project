// Form Validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const required = this.querySelectorAll('[required]');
            
            required.forEach(input => {
                if (input.value.trim() === '') {
                    isValid = false;
                    input.style.borderColor = 'red';
                } else {
                    input.style.borderColor = '';
                }
            });
            
            // Password confirmation
            const password = this.querySelector('#password');
            const confirm = this.querySelector('#confirm_password');
            if (password && confirm && password.value !== confirm.value) {
                isValid = false;
                confirm.style.borderColor = 'red';
                alert('Passwords do not match!');
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    });
});

// Password strength indicator (optional)
function checkPasswordStrength(password) {
    let score = 0;
    if (password.length >= 8) score++;
    if (/[a-z]/.test(password)) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) score++;
    
    const labels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong', 'Very Strong'];
    return labels[score] || 'Very Weak';
}