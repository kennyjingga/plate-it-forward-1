import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'gotham': ['Gotham HTF'],
                'brandon': ['BrandonGrotesque'],
                'brandonLight': ['BrandonGrotesque-Light']
            },
            // fontFamily: {
            //     'font-gotham': ['GothamBold'],
            //     'font-brandon-black-italic': ['BrandonBlackItalic'],
            //     'font-brandon-black': ['BrandonBlack'],
            //     'font-brandon-bold-italic': ['BrandonBoldItalic'],
            //     'font-brandon-bold': ['BrandonBold'],
            //     'font-brandon-light-italic': ['BrandonLightItalic'],
            //     'font-brandon-light': ['BrandonLight'],
            //     'font-brandon-medium-italic': ['BrandonMediumItalic'],
            //     'font-brandon-medium': ['BrandonMedium'],
            //     'font-brandon-regular-italic': ['BrandonRegularItalic'],
            //     'font-brandon': ['BrandonRegular'],
            //     'font-brandon-thin-italic': ['BrandonThinItalic'],
            //     'font-brandon-thin': ['BrandonThin'],
            // },
            colors: {
                'DefaultGreen': '#00615F',
                'DefaultWhite': '#F9F3F0',
                'Teal': '#38b2ac',
                'LightGreen': 'rgba(0, 97, 95, 0.5)'
            },
            maxWidth: {
                '6.7xl': '74rem',
            },
            backgroundImage: {
                'bgbang': "url('/public/assets/Image/judul.png')",
                'bglocation': "url('/public/assets/Image/keram_telor.png')",
            },
        },
    },
    plugins: [],
};


