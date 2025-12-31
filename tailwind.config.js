import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            // MENDAFTARKAN FONT INSTANSI
            fontFamily: {
                sans: ['"Titillium Web"', ...defaultTheme.fontFamily.sans],
                titillium: ['"Titillium Web"', 'sans-serif'],
            },
            // MENDAFTARKAN WARNA INSTANSI
            colors: {
                midnight: '#07213D', // Warna Utama (Gelap)
                gold: '#EEBF63',     // Warna Aksen (Emas)
                platinum: '#E0E2E3', // Warna Teks/Secondary
            }
        },
    },

    plugins: [],
};