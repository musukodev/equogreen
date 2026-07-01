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
            colors: {
                primary: '#4039c9',
                accent: '#002eff',
                brand: {
                    bg: '#f1f5fa',
                }
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                modalSlideUp: {
                    'from': { opacity: '0', transform: 'translateY(24px) scale(0.96)' },
                    'to': { opacity: '1', transform: 'translateY(0) scale(1)' },
                }
            },
            animation: {
                'fade-in': 'fadeIn 0.25s ease-out forwards',
                'modal-slide-up': 'modalSlideUp 0.3s ease-out forwards',
            }
        },
    },

    plugins: [forms],
};
