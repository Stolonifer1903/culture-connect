/**
 * CultureConnect Form Validation Library
 * Provides reusable validation logic and UI feedback helpers.
 */

const FormValidation = {
    /**
     * Shows an error message for an input element using Bootstrap styling.
     * @param {HTMLElement} input - The input element to show the error for.
     * @param {string} message - The error message to display.
     */
    showError: function(input, message) {
        this.clearError(input);
        input.classList.add('is-invalid');
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.innerText = message;
        
        // Append after the input
        input.parentNode.appendChild(errorDiv);
    },

    /**
     * Clears error styling and messages for an input element.
     * @param {HTMLElement} input - The input element to clear.
     */
    clearError: function(input) {
        input.classList.remove('is-invalid');
        const errorDiv = input.parentNode.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.remove();
        }
    },

    /**
     * Validates if a field is not empty.
     */
    validateRequired: function(input, message = 'This field is required.') {
        if (!input.value.trim()) {
            this.showError(input, message);
            return false;
        }
        this.clearError(input);
        return true;
    },

    /**
     * Validates email format.
     */
    validateEmail: function(input) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!this.validateRequired(input, 'Email is required.')) return false;
        if (!emailRegex.test(input.value.trim())) {
            this.showError(input, 'Please enter a valid email address.');
            return false;
        }
        this.clearError(input);
        return true;
    },

    /**
     * Validates minimum length.
     */
    validateMinLength: function(input, min, message) {
        if (!this.validateRequired(input)) return false;
        if (input.value.trim().length < min) {
            this.showError(input, message || `Must be at least ${min} characters.`);
            return false;
        }
        this.clearError(input);
        return true;
    },

    /**
     * Validates a select element ensuring a value is picked.
     */
    validateSelect: function(input, message = 'Please select an option.') {
        if (!input.value || input.value === "" || input.value === "Select...") {
            this.showError(input, message);
            return false;
        }
        this.clearError(input);
        return true;
    },

    /**
     * Validates phone format (basic).
     */
    validatePhone: function(input) {
        const phoneRegex = /^[\d\s\+\-\(\)]{7,20}$/;
        if (!this.validateRequired(input, 'Phone number is required.')) return false;
        if (!phoneRegex.test(input.value.trim())) {
            this.showError(input, 'Please enter a valid phone number.');
            return false;
        }
        this.clearError(input);
        return true;
    },

    /**
     * Validates URL format.
     */
    validateUrl: function(input) {
        if (!this.validateRequired(input, 'Website URL is required.')) return false;
        try {
            new URL(input.value.trim());
            this.clearError(input);
            return true;
        } catch (_) {
            this.showError(input, 'Please enter a valid URL (e.g., https://example.com).');
            return false;
        }
    }
};
