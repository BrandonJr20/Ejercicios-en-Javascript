document.addEventListener('DOMContentLoaded', () => {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    nameInput.addEventListener('keyup', validateName);
    emailInput.addEventListener('keyup', validateEmail);
    passwordInput.addEventListener('keyup', validatePassword);

    function validateName() {
        const value = nameInput.value;
        if (!/^[a-zA-Z]{3,}$/.test(value)) {
            nameError.textContent = 'El nombre debe tener al menos 3 letras.';
            nameError.style.display = 'block';
        } else {
            nameError.style.display = 'none';
        }
    }

    function validateEmail() {
        const value = emailInput.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(value)) {
            emailError.textContent = 'Por favor, introduce un correo válido.';
            emailError.style.display = 'block';
        } else {
            emailError.style.display = 'none';
        }
    }

    function validatePassword() {
        const value = passwordInput.value;
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!passwordPattern.test(value)) {
            passwordError.textContent = 'La contraseña debe incluir mayúsculas, minúsculas, números y símbolos.';
            passwordError.style.display = 'block';
        } else {
            passwordError.style.display = 'none';
        }
    }

    document.getElementById('registrationForm').addEventListener('submit', (e) => {
        e.preventDefault();
        validateName();
        validateEmail();
        validatePassword();

        // Check if there are no error messages before submission
        if (!nameError.textContent && !emailError.textContent && !passwordError.textContent) {
            alert('Registro exitoso!');
        } else {
            alert('Por favor, corrige los errores antes de enviar.');
        }
    });
});
