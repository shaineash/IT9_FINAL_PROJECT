import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const togglePassword = (button) => {
    const targetId = button.getAttribute('data-password-toggle');
    const passwordInput = document.getElementById(targetId);
    if (!passwordInput) {
        return;
    }

    const isVisible = passwordInput.type === 'text';
    passwordInput.type = isVisible ? 'password' : 'text';
    button.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');

    const showIcon = button.querySelector('.password-toggle-show');
    const hideIcon = button.querySelector('.password-toggle-hide');
    if (showIcon && hideIcon) {
        showIcon.classList.toggle('hidden', !isVisible);
        hideIcon.classList.toggle('hidden', isVisible);
    }
};

const syncToggleButtonState = (button) => {
    const targetId = button.getAttribute('data-password-toggle');
    const input = document.getElementById(targetId);
    if (!input) {
        return;
    }

    const isVisible = input.type === 'text';
    const showIcon = button.querySelector('.password-toggle-show');
    const hideIcon = button.querySelector('.password-toggle-hide');
    if (showIcon && hideIcon) {
        showIcon.classList.toggle('hidden', isVisible);
        hideIcon.classList.toggle('hidden', !isVisible);
    }

    button.setAttribute('aria-label', isVisible ? 'Hide password' : 'Show password');
};

const initializePasswordToggles = () => {
    document.querySelectorAll('[data-password-toggle]').forEach(syncToggleButtonState);
};

const handlePasswordToggleClick = (event) => {
    const button = event.target.closest('button[data-password-toggle]');
    if (!button) {
        return;
    }

    event.preventDefault();
    togglePassword(button);
};

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

document.addEventListener('click', handlePasswordToggleClick);
document.addEventListener('input', passwordValidationHandler);

const initializePage = () => {
    initializePasswordToggles();

    // Also initialize any helpers for password inputs without toggles
    document.querySelectorAll('input.password-input').forEach(input => updatePasswordHelper(input));
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializePage);
} else {
    initializePage();
}
