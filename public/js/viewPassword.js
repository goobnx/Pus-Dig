document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelectorAll('.togglePassword');
    const passwordFields = document.querySelectorAll('.passwordField');

    togglePassword.forEach((button, index) => {
        button.addEventListener('click', function() {
            const passwordField = passwordFields[index];
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            this.innerHTML = type === 'password' ? '<iconify-icon icon="tabler:eye-off" class="fs-6"></iconify-icon>' :
                '<iconify-icon icon="tabler:eye" class="fs-6"></iconify-icon>';
        });
    });
});