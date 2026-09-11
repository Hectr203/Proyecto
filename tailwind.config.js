import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                "body-lg": ["Plus Jakarta Sans"], "display-hero-mobile": ["Plus Jakarta Sans"], "headline-sm": ["Plus Jakarta Sans"], "headline-lg": ["Plus Jakarta Sans"], "body-md": ["Plus Jakarta Sans"], "label-promotional": ["Plus Jakarta Sans"], "label-sm": ["Plus Jakarta Sans"], "headline-md": ["Plus Jakarta Sans"], "display-hero": ["Plus Jakarta Sans"], "headline-lg-mobile": ["Plus Jakarta Sans"], "body-sm": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"]
            },
            colors: {
                "on-background": "#1b1b1d", "on-primary-fixed": "#400100", "on-surface": "#1b1b1d", "surface-tint": "#ac3323", "on-tertiary-container": "#093b30", "on-error-container": "#93000a", "on-tertiary-fixed": "#002019", "outline-variant": "#e0bfba", "surface-variant": "#e4e2e4", "tertiary-container": "#78a697", "primary": "#ac3323", "inverse-surface": "#303032", "on-primary": "#ffffff", "on-tertiary": "#ffffff", "on-secondary-fixed-variant": "#673b34", "primary-fixed": "#ffdad4", "tertiary": "#3a6759", "surface-container-low": "#f6f3f5", "surface-container-lowest": "#ffffff", "surface-container-high": "#eae7ea", "error-container": "#ffdad6", "primary-container": "#ff6f59", "secondary-fixed-dim": "#f7b7ae", "on-primary-container": "#6e0400", "inverse-on-surface": "#f3f0f2", "on-secondary-container": "#794943", "on-secondary": "#ffffff", "on-primary-fixed-variant": "#8a1a0e", "tertiary-fixed-dim": "#a1d0c0", "surface-bright": "#fcf8fb", "background": "#fcf8fb", "on-error": "#ffffff", "secondary-fixed": "#ffdad5", "inverse-primary": "#ffb4a7", "on-surface-variant": "#58413d", "tertiary-fixed": "#bceddc", "surface-container-highest": "#e4e2e4", "primary-fixed-dim": "#ffb4a7", "on-tertiary-fixed-variant": "#214f42", "surface": "#fcf8fb", "error": "#ba1a1a", "outline": "#8c716c", "surface-dim": "#dcd9dc", "surface-container": "#f0edef", "secondary-container": "#fdbdb3", "on-secondary-fixed": "#33110c", "secondary": "#83524a"
            },
            spacing: {
                "space-lg": "1.5rem", "gutter-mobile": "0.75rem", "margin-mobile": "1rem", "space-xl": "2.5rem", "space-sm": "0.5rem", "gutter": "1.5rem", "space-md": "1rem", "space-xs": "0.25rem", "margin": "3rem"
            },
            fontSize: {
                "body-lg": ["16px", { lineHeight: "24px", letterSpacing: "-0.005em", fontWeight: "400" }],
                "display-hero-mobile": ["34px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "700" }],
                "headline-sm": ["18px", { lineHeight: "24px", letterSpacing: "-0.01em", fontWeight: "600" }],
                "headline-lg": ["32px", { lineHeight: "38px", letterSpacing: "-0.02em", fontWeight: "600" }],
                "body-md": ["14px", { lineHeight: "20px", letterSpacing: "0em", fontWeight: "400" }],
                "label-promotional": ["11px", { lineHeight: "14px", letterSpacing: "0.06em", fontWeight: "700" }],
                "label-sm": ["11px", { lineHeight: "14px", letterSpacing: "0.02em", fontWeight: "500" }],
                "headline-md": ["22px", { lineHeight: "28px", letterSpacing: "-0.015em", fontWeight: "600" }],
                "display-hero": ["48px", { lineHeight: "54px", letterSpacing: "-0.025em", fontWeight: "700" }],
                "headline-lg-mobile": ["26px", { lineHeight: "32px", letterSpacing: "-0.015em", fontWeight: "600" }],
                "body-sm": ["12px", { lineHeight: "16px", letterSpacing: "0.01em", fontWeight: "400" }],
                "label-md": ["13px", { lineHeight: "16px", letterSpacing: "0.01em", fontWeight: "600" }]
            }
        },
    },

    plugins: [forms],
};
