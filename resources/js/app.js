import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const updatePasswordHelper = (input) => {
    const helper = document.querySelector(`[data-password-helper-for="${input.id}"]`);
    if (!helper) {
        return;
    }

    const length = input.value.length;
    if (length === 0) {
        helper.textContent = 'Password must contain at least 8 characters.';
        helper.classList.remove('text-[#c9a77c]', 'text-[#ef4444]');
        helper.classList.add('text-[#8a8a8a]');
        return;
    }

    if (length < 8) {
        helper.textContent = '✖ Password too short';
        helper.classList.remove('text-[#c9a77c]', 'text-[#8a8a8a]');
        helper.classList.add('text-[#ef4444]');
    } else {
        helper.textContent = '✔ Password length valid';
        helper.classList.remove('text-[#ef4444]', 'text-[#8a8a8a]');
        helper.classList.add('text-[#c9a77c]');
    }
};

const passwordValidationHandler = (event) => {
    const input = event.target.closest('input.password-input');
    if (!input) {
        return;
    }

    updatePasswordHelper(input);
};

const handleShowPasswordToggle = (event) => {
    const checkbox = event.target.closest('input[type="checkbox"][data-show-password-target]');
    if (!checkbox) {
        return;
    }

    const target = document.getElementById(checkbox.dataset.showPasswordTarget);
    if (!target) {
        return;
    }

    target.type = checkbox.checked ? 'text' : 'password';
};

document.addEventListener('input', passwordValidationHandler);
document.addEventListener('change', handleShowPasswordToggle);

const initializePage = () => {
    // Initialize helpers for password inputs
    document.querySelectorAll('input.password-input').forEach(input => updatePasswordHelper(input));
    document.querySelectorAll('input[type="checkbox"][data-show-password-target]').forEach(checkbox => {
        const target = document.getElementById(checkbox.dataset.showPasswordTarget);
        if (!target) {
            return;
        }

        target.type = checkbox.checked ? 'text' : 'password';
    });
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializePage);
} else {
    initializePage();
}
