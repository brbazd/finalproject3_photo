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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'user-banner-dark': "url('/resources/images/banner-dark.jpg')",
                'user-banner-light': "url('/resources/images/banner-light.jpg')",
                'homepage-dark': "url('/resources/images/homepage-dark.jpg)",
                'homepage-light': "url('/resources/images/homepage-light.jpg)"
            },
            maxHeight: {
                '120': '480px',
            },
            screens: {
                'xs': '576px',
            }
        },
    },

    plugins: [forms],
};
