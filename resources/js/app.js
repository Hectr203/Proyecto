import './bootstrap';
import Toastify from 'toastify-js';
import "toastify-js/src/toastify.css";

// Make toast available globally
window.toast = {
    success: function(message) {
        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#10b981", // Emerald 500 for success
                color: "#ffffff",
                borderRadius: "8px",
                boxShadow: "0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)",
                fontFamily: "inherit",
                fontSize: "14px",
                fontWeight: "500",
                padding: "12px 20px"
            }
        }).showToast();
    },
    error: function(message) {
        Toastify({
            text: message,
            duration: 4000,
            close: true,
            gravity: "bottom",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#ef4444", // Red 500 for error
                color: "#ffffff",
                borderRadius: "8px",
                boxShadow: "0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)",
                fontFamily: "inherit",
                fontSize: "14px",
                fontWeight: "500",
                padding: "12px 20px"
            }
        }).showToast();
    },
    info: function(message) {
        Toastify({
            text: message,
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#3b82f6", // Blue 500 for info
                color: "#ffffff",
                borderRadius: "8px",
                boxShadow: "0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)",
                fontFamily: "inherit",
                fontSize: "14px",
                fontWeight: "500",
                padding: "12px 20px"
            }
        }).showToast();
    }
};
