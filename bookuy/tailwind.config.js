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
                sans: ['Poppins', 'system-ui', ...defaultTheme.fontFamily.sans],
                header: ['Sugo Pro Classic Regular Trial', 'Poppins', 'system-ui', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Primary colors from Figma
                'primary': '#3B82F6',      // Main blue
                'primary-dark': '#2563EB', // Darker blue for hover
                'primary-light': '#60A5FA', // Lighter blue
                
                // Background colors
                'page-bg': '#F8FAFC',      // Light gray background
                'card-bg': '#FFFFFF',      // White card background
                'dark-bg': '#1E293B',      // Dark background
                
                // Text colors
                'text-primary': '#0F172A', // Primary dark text
                'text-secondary': '#64748B', // Secondary gray text
                'text-muted': '#94A3B8',   // Muted text
                'text-white': '#FFFFFF',   // White text
                
                // Border & divider
                'border-gray': '#E2E8F0',  // Light gray border
                'border-light': '#F1F5F9', // Lighter border
                
                // Status colors
                'success': '#10B981',      // Green
                'danger': '#EF4444',       // Red
                'warning': '#F59E0B',      // Orange
                'info': '#3B82F6',         // Blue
                
                // Accent colors
                'orange': '#FF9500',       // Orange accent
                'yellow': '#FCD34D',       // Yellow tag
            },
            borderRadius: {
                'xl': '1rem',
                '2xl': '1.5rem',
                '3xl': '2rem',
            },
            boxShadow: {
                'sm': '0 1px 2px rgba(0, 0, 0, 0.05)',
                'card': '0 2px 8px rgba(0, 0, 0, 0.08)',
                'lg': '0 4px 12px rgba(0, 0, 0, 0.1)',
                'button': '0 4px 12px rgba(59, 130, 246, 0.3)',
            },
        },
    },

    plugins: [forms],
};